<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');

// --- Le8sea Ke Main Routes (Movies) ---
Route::get('/', [HomeController::class, 'index']);
Route::get('/search', [HomeController::class, 'search'])->name('movie.search');
Route::get('/movie/{id}', [HomeController::class, 'show'])->name('movie.show');

// --- TV Series Ke Routes ---
Route::get('/tv', [HomeController::class, 'tvIndex'])->name('tv.index');
Route::get('/tv/{id}', [HomeController::class, 'tvShow'])->name('tv.show');

// --- Books Ke Routes ---
Route::get('/books', [HomeController::class, 'booksIndex'])->name('books.index');
Route::get('/books/search', [HomeController::class, 'bookSearch'])->name('books.search');
Route::get('/books/{id}', [HomeController::class, 'bookShow'])->name('books.show');

// --- Music Ke Routes ---
Route::get('/music', [HomeController::class, 'musicIndex'])->name('music.index');
Route::get('/music/search', [HomeController::class, 'musicSearch'])->name('music.search');
Route::get('/music/{id}', [HomeController::class, 'musicShow'])->name('music.show');

// --- Le8sea Custom User Profile Dashboard ---
Route::get('/dashboard', function () {
    $user = Auth::user();
    // User ke saare reviews database se nikal rahe hain
    $reviews = Review::where('user_id', $user->id)->latest()->get();
    
    return view('dashboard', [
        'user' => $user,
        'reviews' => $reviews
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// --- Breeze Profile Settings Routes ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';