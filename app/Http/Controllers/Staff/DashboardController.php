<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Report;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $staffId = Auth::id();
        $today = Carbon::today();

        // ======================
        // STATISTIK TUGAS
        // ======================

        $tugasHariIni = Booking::where('staff_id', $staffId)
            ->whereDate('booking_date', $today)
            ->where('status', 'assigned')
            ->count();

        $tugasSelesai = Booking::where('staff_id', $staffId)
            ->where('status', 'completed')
            ->count();

        $tugasBerjalan = Booking::where('staff_id', $staffId)
            ->where('status', 'in_progress')
            ->count();

        // ======================
        // AKTIVITAS TERBARU
        // ======================

        // 1. Tugas baru yang ditambahkan admin hari ini
        $tugasBaru = Booking::where('staff_id', $staffId)
            ->where('status', 'assigned')
            ->whereDate('created_at', $today)
            ->count();

        // 2. Booking selesai atau berjalan hari ini
        $bookingSelesaiHariIni = Booking::where('staff_id', $staffId)
            ->whereIn('status', ['completed', 'in_progress'])
            ->whereDate('booking_date', $today)
            ->count();

        // 3. Laporan harian
        $laporanHariIni = Report::where('staff_id', $staffId)
            ->whereDate('created_at', $today)
            ->count();

        return view('staff.dashboard', compact(
            'tugasHariIni',
            'tugasSelesai',
            'tugasBerjalan',
            'tugasBaru',
            'bookingSelesaiHariIni',
            'laporanHariIni'
        ));
    }
}
