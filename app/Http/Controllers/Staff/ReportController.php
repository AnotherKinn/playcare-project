<?php

namespace App\Http\Controllers\Staff;

use App\Events\ChildReportSubmitted;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Booking;
use App\Models\Child;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        // Ambil anak yang booking-nya sedang in_progress
        $children = Child::whereHas('bookings', function ($q) {
            $q->where('status', 'in_progress');
        })->get();

        // Ambil semua laporan + filter nama anak
        $reports = Report::with(['child', 'booking'])
            ->where('staff_id', Auth::id())
            ->when($search, function ($q) use ($search) {
                $q->whereHas('child', function ($childQuery) use ($search) {
                    $childQuery->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        foreach ($reports as $r) {
            $r->photo_url = $r->photo ? Storage::url($r->photo) : null;
        }

        return view('staff.report.index', compact('reports', 'children', 'search'));
    }



    public function create()
    {
        // Ambil anak-anak yang sedang ditugaskan ke staff login
        // dan memiliki booking dengan status 'approved'
        $children = Child::whereHas('bookings', function ($q) {
            $q->where('status', 'in_progress')
                ->where('staff_id', Auth::id());
        })->get();

        return view('staff.report.create', compact('children'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_id' => 'required|exists:children,id',
            'meals' => 'nullable|string',
            'sleep' => 'nullable|string',
            'activities' => 'required|string',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        $booking = Booking::where('child_id', $validated['child_id'])
            ->where('staff_id', Auth::id())
            ->where('status', 'in_progress')
            ->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking anak ini tidak ditemukan atau belum disetujui.');
        }

        $report = new Report();
        $report->child_id = $validated['child_id'];
        $report->booking_id = $booking->id;
        $report->staff_id = Auth::id();
        $report->meals = $validated['meals'] ?? null;
        $report->sleep = $validated['sleep'] ?? null;
        $report->activities = $validated['activities'];
        $report->notes = $validated['notes'] ?? null;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('report_photos', 'public');
            $report->photo = $path;
        }

        $report->save();

        Notification::create([
            'user_id' => Auth::id(),
            'booking_id' => $booking->id,
            'type_notification' => 'report_child'
        ]);

        // ✅ Trigger Event untuk admin
        event(new ChildReportSubmitted($report));

        return redirect()->route('staff.report.index')->with('success', 'Laporan berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $report = Report::findOrFail($id);
        return view('staff.report.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $validated = $request->validate([
            'meals' => 'nullable|string',
            'sleep' => 'nullable|string',
            'activities' => 'required|string',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        $report->meals = $validated['meals'] ?? null;
        $report->sleep = $validated['sleep'] ?? null;
        $report->activities = $validated['activities'];
        $report->notes = $validated['notes'] ?? null;

        if ($request->hasFile('photo')) {
            // hapus foto lama kalau ada
            if ($report->photo && Storage::disk('public')->exists($report->photo)) {
                Storage::disk('public')->delete($report->photo);
            }

            $path = $request->file('photo')->store('report_photos', 'public');
            $report->photo = $path;
        }

        $report->save();

        return redirect()->route('staff.report.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        if ($report->photo && Storage::disk('public')->exists($report->photo)) {
            Storage::disk('public')->delete($report->photo);
        }

        $report->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus!');
    }
}
