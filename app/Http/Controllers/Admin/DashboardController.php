<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // === 1. Statistik dasar ===
        $totalParents = User::where('role', 'parent')->count();
        $totalStaff   = User::where('role', 'staff')->count();
        $bookingAktif = Booking::where('status', 'pending')->orWhere('status', 'completed')->count();
        $transaksiPending = Transaction::where('status', 'pending')->count();

        // === 2. Pendapatan bulan ini ===
        $pendapatanBulanIni = Transaction::where('status', 'success')
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        // === 3. Data untuk grafik pendapatan bulanan ===
        $incomeData = Transaction::select(
                DB::raw('MONTH(paid_at) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->where('status', 'success')
            ->whereYear('paid_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Buat array dari Jan–Des biar chart-nya rapi
        $months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $incomeData[$i] ?? 0;
        }

        // === 4. Booking terbaru ===
        $bookingTerbaru = Booking::with(['parent:id,name', 'assignedStaff'])
            ->latest()
            ->take(5)
            ->get();

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalParents',
            'totalStaff',
            'bookingAktif',
            'transaksiPending',
            'pendapatanBulanIni',
            'months',
            'chartData',
            'bookingTerbaru'
        ));
    }
}
