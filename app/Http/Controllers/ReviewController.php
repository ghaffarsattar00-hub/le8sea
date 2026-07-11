<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return back()->with('success', 'Review submitted successfully!');
    }
}