<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffReport;
use App\Models\Review;
use App\Models\IncomeReport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        // Hitung total laporan staff
        $totalStaffReports = \App\Models\StaffReport::count();

        // Hitung total review parent
        $totalParentReviews = \App\Models\Review::count();

        // Hitung total pendapatan (semua transaksi yang confirmed)
        $totalIncome = \App\Models\Transaction::where('status', 'confirmed')->sum('amount');

        // Hitung total transaksi yang confirmed
        $totalTransactions = \App\Models\Transaction::where('status', 'confirmed')->count();

        return view('admin.reports.index', compact(
            'totalStaffReports',
            'totalParentReviews',
            'totalIncome',
            'totalTransactions'
        ));
    }


    public function indexStaffReport()
    {
        $staffReports = StaffReport::with(['staff', 'booking'])->latest()->get();

        return view('admin.reports.staff-report.index', compact('staffReports'));
    }

    public function indexParentReview()
    {
        // Ambil semua review, beserta relasi parent (user) dan booking
        $reviews = Review::with(['parent', 'booking'])
            ->latest()
            ->get();

        return view('admin.reports.parent-review.index', compact('reviews'));
    }

    public function indexIncomeReport()
    {
        // Ambil bulan & tahun saat ini
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Hitung total pendapatan dan transaksi bulan ini
        $totalIncome = Transaction::where('status', 'confirmed')
            ->whereMonth('paid_at', $currentMonth)
            ->whereYear('paid_at', $currentYear)
            ->sum('amount');

        $totalTransactions = Transaction::where('status', 'confirmed')
            ->whereMonth('paid_at', $currentMonth)
            ->whereYear('paid_at', $currentYear)
            ->count();

        // Simpan atau update laporan ke tabel income_reports
        IncomeReport::updateOrCreate(
            ['month' => $currentMonth, 'year' => $currentYear],
            [
                'total_income' => $totalIncome,
                'total_transactions' => $totalTransactions,
                'created_by' => Auth::id(),
            ]
        );

        // Data untuk Chart.js
        $monthlyIncome = IncomeReport::orderBy('year')
            ->orderBy('month')
            ->get();

        // Konversi data ke format label dan value
        $months = $monthlyIncome->map(function ($report) {
            return date('F', mktime(0, 0, 0, $report->month, 1)) . ' ' . $report->year;
        });

        $totals = $monthlyIncome->pluck('total_income');

        // Ambil semua transaksi (detail)
        $transactions = Transaction::with(['booking.parent'])
            ->latest()
            ->get();

        return view('admin.reports.income-report.index', compact('months', 'totals', 'transactions'));
    }

    public function indexChildrenReport()
    {
        return view('admin.reports.children-report.index');
    }
}
