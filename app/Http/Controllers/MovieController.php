<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Auth::user()->movies()->latest()->get();
        return view('dashboard', compact('movies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string',
        ]);

        Auth::user()->movies()->create([
            'title' => $request->title,
            'genre' => $request->genre,
            'status' => 'belum',
        ]);

        return back()->with('success', 'Film ditambahkan!');
    }

    public function update(Request $request, Movie $movie)
    {
        if ($movie->user_id !== Auth::id()) abort(403);

        // Jika request memiliki input 'title', berarti user sedang mengedit detail
        if ($request->has('title')) {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'genre' => 'required|string',
            ]);
            $movie->update($validated);
            return back()->with('success', 'Detail film diperbarui!');
        }

        // Jika tidak ada input title, maka jalankan fungsi toggle status (sudah/belum)
        $newStatus = $movie->status === 'belum' ? 'sudah' : 'belum';
        $movie->update(['status' => $newStatus]);

        return back();
    }

    public function destroy(Movie $movie)
    {
        if ($movie->user_id !== Auth::id()) abort(403);
        $movie->delete();
        return back()->with('success', 'Film dihapus!');
    }
}