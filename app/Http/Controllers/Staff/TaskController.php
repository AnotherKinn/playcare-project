<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Child;
use App\Models\StaffSchedule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Tampilkan daftar tugas staff (dengan filter)
     */
    public function index(Request $request)
    {
        $query = Booking::with(['child', 'parent'])
            ->where('staff_id', Auth::id())
            ->whereIn('status', ['assigned', 'in_progress']); // 🔥 hanya tampilkan tugas aktif


        // 🔍 Filter berdasarkan pencarian nama anak
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('child', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            switch ($request->status) {
                case 'assigned':
                    $query->where('status', 'assigned');
                    break;
                case 'in_progress':
                    $query->where('status', 'in_progress');
                    break;
                case 'completed':
                    // completed tidak ditampilkan di halaman
                    $query->whereRaw('1=0');
                    break;
            }
        }


        $tasks = $query->orderBy('booking_date', 'desc')->get();

        return view('staff.task.index', compact('tasks'));
    }


    /**
     * Tampilkan form tambah tugas
     */
    public function create()
    {
        $children = Child::with('parent')->get();
        return view('staff.task.create', compact('children'));
    }

    /**
     * Simpan tugas baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
            'service_type' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'duration_hours' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        Booking::create([
            'parent_id' => $request->child->parent_id ?? $request->parent_id,
            'child_id' => $request->child_id,
            'service_type' => $request->service_type,
            'duration_hours' => $request->duration_hours,
            'booking_date' => $request->booking_date,
            'notes' => $request->notes,
            'status' => 'assigned',
            'staff_id' => Auth::id(),
            'total_price' => 0, // bisa disesuaikan
        ]);

        return redirect()->route('staff.task.index')->with('success', 'Tugas baru berhasil ditambahkan.');
    }

    /**
     * Detail satu tugas (modal atau halaman terpisah)
     */
    public function show($id)
    {
        $task = Booking::with(['child', 'parent'])->findOrFail($id);
        return view('staff.task.show', compact('task'));
    }

    /**
     * Form edit tugas
     */
    public function edit($id)
    {
        $task = Booking::findOrFail($id);
        $children = Child::with('parent')->get();
        return view('staff.task.edit', compact('task', 'children'));
    }

    /**
     * Update data tugas
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
            'service_type' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'duration_hours' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $task = Booking::findOrFail($id);

        $task->update($request->only('child_id', 'service_type', 'booking_date', 'duration_hours', 'notes', 'status'));

        // jika status booking selesai, update semua schedule terkait
        if ($request->status === 'completed' && $task->staff_id) {
            $staffSchedules = StaffSchedule::where('staff_id', $task->staff_id)
                ->where('booking_id', $task->id)
                ->get();

            foreach ($staffSchedules as $schedule) {
                $schedule->update([
                    'status' => 'active',
                    'booking_id' => null,
                ]);
            }
        }

        return redirect()->route('staff.task.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    /**
     * Hapus tugas
     */
    public function destroy($id)
    {
        $task = Booking::findOrFail($id);
        $task->delete();

        return redirect()->route('staff.task.index')->with('success', 'Tugas berhasil dihapus.');
    }

    /**
     * Update status tugas (khusus tombol di modal)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:in_progress,completed',
        ]);

        $task = Booking::findOrFail($id);

        // Update status booking
        $task->update([
            'status' => $request->status
        ]);

        // Jika tugas selesai, kosongkan jadwal staff
        if ($request->status === 'completed' && $task->staff_id) {

            StaffSchedule::where('staff_id', $task->staff_id)
                ->where('booking_id', $task->id)
                ->update([
                    'status' => 'active',      // bebaskan slot jadwal
                    'booking_id' => null       // detach booking
                ]);
        }

        return redirect()->route('staff.task.index')
            ->with('success', 'Status tugas berhasil diperbarui.');
    }
}
