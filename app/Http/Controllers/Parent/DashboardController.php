<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Child;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Hitung jumlah berdasarkan status booking
        $activeBookings = Booking::where('parent_id', $userId)
            ->where('status', 'aktif')
            ->count();

        $pendingPayments = Booking::where('parent_id', $userId)
            ->where('status', 'menunggu pembayaran')
            ->count();

        $completedBookings = Booking::where('parent_id', $userId)
            ->where('status', 'selesai')
            ->count();

        // Hitung jumlah anak
        $registeredChildren = Child::where('parent_id', $userId)->count();

        // Ambil 3 booking terbaru
        $latestBookings = Booking::where('parent_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        return view('parent.dashboard', compact(
            'activeBookings',
            'pendingPayments',
            'completedBookings',
            'registeredChildren',
            'latestBookings'
        ));
    }
}
