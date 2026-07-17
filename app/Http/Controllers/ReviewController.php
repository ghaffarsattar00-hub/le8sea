<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;  // Nayi line: API call ke liye
use Illuminate\Support\Facades\Cache; // Nayi line: Verdict save karne ke liye

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'review_text' => 'required|min:5',
            'media_id' => 'required',
            // Yahan humne 'music' ko bhi allow kar diya hai!
            'media_type' => 'required|in:movie,tv,book,music', 
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'media_id' => $request->media_id,
            'media_type' => $request->media_type, 
            'review_text' => $request->review_text,
        ]);

        // ==========================================
        // AI VERDICT LOGIC START
        // ==========================================

        // 1. Us specific media (movie ya gaane) ke saare reviews nikalen
        $allReviews = Review::where('media_id', $request->media_id)
                            ->where('media_type', $request->media_type)
                            ->pluck('review_text') // Aapke table ke hisaab se
                            ->implode("\n- ");

        $prompt = "";

        // 2. Decide karein ke AI ko kya banna hai
        if ($request->media_type == 'movie' || $request->media_type == 'tv') {
            $prompt = "You are a professional and witty movie/TV critic. Read the following user reviews and write a dynamic 'AI Verdict' (max 3 sentences). STRICT RULES: 1. NEVER start with 'Based on X reviews'. 2. DO NOT use generic words like 'pacing', 'third act', or 'solid watch' unless explicitly mentioned by users. 3. Write like a real human, telling what the crowd loved or hated. \nUser Reviews: \n- " . $allReviews;
        } 
        elseif ($request->media_type == 'music') {
            $prompt = "You are a high-energy music critic writing for Gen-Z. Read these user reviews about a song and write a short, punchy 'AI Verdict' (max 3 sentences). STRICT RULES: 1. NEVER say 'Based on these reviews'. 2. Talk ONLY about the beats, vocals, lyrics, flow, or the overall vibe. 3. Sound like a Rolling Stone magazine editor. \nUser Reviews: \n- " . $allReviews;
        }

        // 3. Gemini API ko Call karein (Agar prompt set hua hai)
        if ($prompt != "") {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
                'contents' => [['parts' => [['text' => $prompt]]]]
            ]);

            if ($response->successful()) {
                $aiVerdict = $response->json('candidates.0.content.parts.0.text');
                
                // 4. Cache mein hamesha ke liye save karein
                // Iska naam banega jaise: ai_verdict_movie_123 ya ai_verdict_music_456
                $cacheKey = 'ai_verdict_' . $request->media_type . '_' . $request->media_id;
                Cache::forever($cacheKey, $aiVerdict);
            }
        }

        // ==========================================
        // AI VERDICT LOGIC END
        // ==========================================

        return back()->with('success', 'Review submitted successfully!');
    }
}
