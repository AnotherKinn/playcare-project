<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\StaffSchedule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $staffs = User::with('staffSchedule')
            ->where('role', 'staff')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->get();


        return view('admin.data-staff.index', compact('staffs', 'search'));
    }


    /**
     * Tampilkan form tambah staff
     */
    public function create()
    {
        return view('admin.data-staff.create');
    }

    /**
     * Simpan data staff baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|max:20',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255'
        ]);

        // 1. Simpan staff baru
        $staff = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // 2. Buat entry default di staff_schedules
        StaffSchedule::create([
            'staff_id' => $staff->id,
            'booking_id' => null, // karena belum ada tugas
            'status' => 'active', // default saat staff baru dibuat
        ]);

        return redirect()->route('admin.data-staff.index')->with('success', 'Staff berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit staff
     */
    public function edit($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        return view('admin.data-staff.edit', compact('staff'));
    }

    /**
     * Update data staff
     */
    public function update(Request $request, $id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $staff->id,
            'password' => 'nullable|string|max:20',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'status' => 'required|in:active,non-active'
        ]);

        // Update data user
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $staff->update($updateData);

        // === UPDATE STATUS DI STAFF SCHEDULE ===
        $schedule = StaffSchedule::where('staff_id', $staff->id)->first();

        if ($schedule) {
            // update schedule yang sudah ada
            $schedule->update([
                'status' => $request->status,
            ]);
        } else {
            // kalau schedule belum ada, buat baru
            StaffSchedule::create([
                'staff_id' => $staff->id,
                'booking_id' => null,
                'status' => $request->status
            ]);
        }

        return redirect()->route('admin.data-staff.index')
            ->with('success', 'Data staff berhasil diperbarui!');
    }


    /**
     * Hapus data staff
     */
    public function destroy($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        $staff->delete();

        return redirect()->route('admin.data-staff.index')->with('success', 'Staff berhasil dihapus!');
    }
}
