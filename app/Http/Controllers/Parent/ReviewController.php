<?php

namespace App\Http\Controllers\Parent;

use App\Events\ReviewSubmitted;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
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
            'feedback_category' => 'required|in:Pelayanan,Kebersihan,Keamanan,Kenyamanan,Fasilitas',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = Review::create([
            'parent_id' => Auth::id(),
            'feedback_category' => $request->feedback_category,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // buat notifikasi untuk admin
        Notification::create([
            'user_id' => 1, // asumsi user_id 1 adalah admin
            'type_notification' => 'review_parent',
            'review_id' => $review->id
        ]);

        // broadcast event ke channel admin
        event(new ReviewSubmitted($review));

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
            'feedback_category' => 'required|in:Pelayanan,Kebersihan,Keamanan,Kenyamanan,Fasilitas',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review->update([
            'feedback_category' => $request->feedback_category,
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
