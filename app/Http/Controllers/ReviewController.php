<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('movie')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // ✅ Fix: 'sudah' bukan 'watched'
        $watchedMovies = Movie::where('user_id', Auth::id())
            ->where('status', 'sudah')
            ->get();

        return view('reviews.index', compact('reviews', 'watchedMovies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id'    => 'required|exists:movies,id',
            'rating'      => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        $sudahAda = Review::where('movie_id', $request->movie_id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($sudahAda) {
            return redirect()->route('reviews.index')
                ->with('error', 'Kamu sudah menulis ulasan untuk film ini.');
        }

        Review::create([
            'movie_id'    => $request->movie_id,
            'user_id'     => Auth::id(),
            'rating'      => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return redirect()->route('reviews.index')
            ->with('success', 'Ulasan berhasil disimpan!');
    }

    public function update(Request $request, Review $review)
    {
        abort_if($review->user_id !== Auth::id(), 403);

        $request->validate([
            'rating'      => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        $review->update([
            'rating'      => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return redirect()->route('reviews.index')
            ->with('success', 'Ulasan berhasil diperbarui!');
    }

    public function destroy(Review $review)
    {
        abort_if($review->user_id !== Auth::id(), 403);

        $review->delete();

        return redirect()->route('reviews.index')
            ->with('success', 'Ulasan berhasil dihapus!');
    }
}