<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Tampilkan semua data staff
     */
    public function index()
    {
        $staffs = User::where('role', 'staff')->get();
        return view('admin.data-staff.index', compact('staffs'));
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
            'role' => 'nullable',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
            'phone' => $request->phone,
            'address' => $request->address,
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
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|max:20',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255'
        ]);

        $staff->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.data-staff.index')->with('success', 'Data staff berhasil diperbarui!');
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
