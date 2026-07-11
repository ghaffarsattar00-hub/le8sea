<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Review; 

class HomeController extends Controller
{
    public function index()
    {
        $response = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/trending/movie/week');

        $trendingMovies = $response->successful() ? $response->json()['results'] : [];

        return view('welcome', [
            'trendingMovies' => array_slice($trendingMovies, 0, 10)
        ]);
    }

    public function show($id)
    {
        $response = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/movie/' . $id);

        if ($response->failed()) {
            abort(404);
        }

        $movie = $response->json();

        $reviews = Review::with('user')
                        ->where('media_id', $id)
                        ->where('media_type', 'movie') 
                        ->latest()
                        ->get();

        $aiVerdict = null;
        if ($reviews->count() >= 3) {
            $reviewsText = $reviews->pluck('review_text')->implode(' | ');
            $prompt = "You are an expert movie critic AI on a platform called Le8sea. Here are user reviews for the movie '{$movie['title']}'. Summarize the overall audience sentiment in 2-3 engaging sentences. Do not give any spoilers. Reviews: " . $reviewsText;

            $geminiResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
                'contents' => [['parts' => [['text' => $prompt]]]]
            ]);

            if ($geminiResponse->successful()) {
                $aiVerdict = $geminiResponse->json('candidates.0.content.parts.0.text');
            } else {
                $aiVerdict = "AI is currently analyzing the reviews. Please check back later!";
            }
        }

        return view('movie', [
            'movie' => $movie,
            'reviews' => $reviews,
            'aiVerdict' => $aiVerdict
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect('/');
        }

        $response = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/search/multi', [
                'query' => $query
            ]);

        $searchResults = $response->successful() ? $response->json()['results'] : [];

        $filteredResults = array_filter($searchResults, function($item) {
            return isset($item['media_type']) && in_array($item['media_type'], ['movie', 'tv']);
        });

        return view('search', [
            'searchResults' => $filteredResults,
            'query' => $query
        ]);
    }

    public function tvIndex()
    {
        $response = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/trending/tv/week');

        $trendingTv = $response->successful() ? $response->json()['results'] : [];

        return view('tv', [
            'trendingTv' => array_slice($trendingTv, 0, 15) 
        ]);
    }

    public function tvShow($id)
    {
        $response = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/tv/' . $id);

        if ($response->failed()) {
            abort(404);
        }

        $show = $response->json();

        $reviews = Review::with('user')
                        ->where('media_id', $id)
                        ->where('media_type', 'tv') 
                        ->latest()
                        ->get();

        $aiVerdict = null;
        if ($reviews->count() >= 3) {
            $reviewsText = $reviews->pluck('review_text')->implode(' | ');
            $prompt = "You are an expert TV series critic AI on a platform called Le8sea. Here are user reviews for the TV series '{$show['name']}'. Summarize the overall audience sentiment in 2-3 engaging sentences. Do not give any spoilers. Reviews: " . $reviewsText;

            $geminiResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
                'contents' => [['parts' => [['text' => $prompt]]]]
            ]);

            if ($geminiResponse->successful()) {
                $aiVerdict = $geminiResponse->json('candidates.0.content.parts.0.text');
            } else {
                $aiVerdict = "AI is currently analyzing the reviews. Please check back later!";
            }
        }

        return view('tv-details', [
            'show' => $show,
            'reviews' => $reviews,
            'aiVerdict' => $aiVerdict
        ]);
    }

    // --- BOOKS LOGIC ---
    public function booksIndex()
    {
        $response = Http::get('https://openlibrary.org/search.json', [
            'q' => 'fiction',
            'limit' => 15
        ]);

        $books = $response->successful() ? $response->json()['docs'] ?? [] : [];

        return view('books', [
            'books' => $books,
            'searchQuery' => null
        ]);
    }

    public function bookSearch(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect()->route('books.index');
        }

        $response = Http::get('https://openlibrary.org/search.json', [
            'q' => $query,
            'limit' => 20
        ]);

        $books = $response->successful() ? $response->json()['docs'] ?? [] : [];

        return view('books', [
            'books' => $books,
            'searchQuery' => $query
        ]);
    }

    public function bookShow($id)
    {
        $response = Http::get('https://openlibrary.org/works/' . $id . '.json');

        if ($response->failed()) {
            abort(404);
        }

        $book = $response->json();

        $reviews = Review::with('user')
                        ->where('media_id', $id)
                        ->where('media_type', 'book') 
                        ->latest()
                        ->get();

        $aiVerdict = null;
        if ($reviews->count() >= 3) {
            $reviewsText = $reviews->pluck('review_text')->implode(' | ');
            $bookTitle = $book['title'] ?? 'this book';
            $prompt = "You are an expert book critic AI on a platform called Le8sea. Here are user reviews for the book '{$bookTitle}'. Summarize the overall reader sentiment in 2-3 engaging sentences. Do not give any spoilers. Reviews: " . $reviewsText;

            $geminiResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
                'contents' => [['parts' => [['text' => $prompt]]]]
            ]);

            if ($geminiResponse->successful()) {
                $aiVerdict = $geminiResponse->json('candidates.0.content.parts.0.text');
            } else {
                $aiVerdict = "AI is currently analyzing the reviews. Please check back later!";
            }
        }

        return view('book-details', [
            'book' => $book,
            'reviews' => $reviews,
            'aiVerdict' => $aiVerdict,
            'bookId' => $id
        ]);
    }

    // --- MUSIC LOGIC (iTunes API) ---
    public function musicIndex()
    {
        $response = Http::get('https://itunes.apple.com/search', [
            'term' => 'diljit dosanjh',
            'entity' => 'song',
            'limit' => 15
        ]);
        
        $tracks = $response->successful() ? $response->json()['results'] ?? [] : [];
        return view('music', ['tracks' => $tracks, 'searchQuery' => null]);
    }

    public function musicSearch(Request $request)
    {
        $query = $request->input('query');
        if (!$query) return redirect()->route('music.index');

        $response = Http::get('https://itunes.apple.com/search', [
            'term' => $query,
            'entity' => 'song',
            'limit' => 20
        ]);

        $tracks = $response->successful() ? $response->json()['results'] ?? [] : [];
        return view('music', ['tracks' => $tracks, 'searchQuery' => $query]);
    }

    public function musicShow($id)
    {
        $response = Http::get('https://itunes.apple.com/lookup', ['id' => $id]);
        
        $data = $response->json();
        if ($response->failed() || empty($data['results'])) abort(404);
        
        $track = $data['results'][0];

        $reviews = Review::with('user')
                        ->where('media_id', $id)
                        ->where('media_type', 'music') 
                        ->latest()
                        ->get();
        
        $aiVerdict = null;
        if ($reviews->count() >= 3) {
            $reviewsText = $reviews->pluck('review_text')->implode(' | ');
            $trackTitle = ($track['trackName'] ?? 'this track') . ' by ' . ($track['artistName'] ?? 'unknown artist');
            $prompt = "You are an expert music critic AI on a platform called Le8sea. Here are user reviews for the music track '{$trackTitle}'. Summarize the overall audience sentiment in 2-3 engaging sentences. Do not give any spoilers. Reviews: " . $reviewsText;

            $geminiResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
                'contents' => [['parts' => [['text' => $prompt]]]]
            ]);

            if ($geminiResponse->successful()) {
                $aiVerdict = $geminiResponse->json('candidates.0.content.parts.0.text');
            } else {
                $aiVerdict = "AI is currently analyzing the reviews. Please check back later!";
            }
        }

        return view('music-details', [
            'track' => $track,
            'reviews' => $reviews,
            'aiVerdict' => $aiVerdict,
            'musicId' => $id
        ]);
    }
}