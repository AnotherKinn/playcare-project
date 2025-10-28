<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        // Ambil semua review milik parent yang sedang login
        $reviews = Review::where('parent_id', Auth::id())->latest()->get();

        return view('parent.review.index', compact('reviews'));
    }

    public function create()
    {
        return view('parent.review.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_type' => 'required|in:full_day,half_day,playground',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'parent_id' => Auth::id(),
            'service_type' => $request->service_type,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('parent.review.index')->with('success', 'Review berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $review = Review::where('parent_id', Auth::id())->findOrFail($id);
        return view('parent.review.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::where('parent_id', Auth::id())->findOrFail($id);

        $request->validate([
            'service_type' => 'required|in:full_day,half_day,playground',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review->update([
            'service_type' => $request->service_type,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('parent.review.index')->with('success', 'Review berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $review = Review::where('parent_id', Auth::id())->findOrFail($id);
        $review->delete();

        return redirect()->route('parent.review.index')->with('success', 'Review berhasil dihapus!');
    }
}
