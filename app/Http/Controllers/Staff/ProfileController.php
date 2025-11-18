<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();


        // Pastikan ini staff
        if ($user->role !== 'staff') {
            abort(403, 'Akses ditolak.');
        }

        // Hitung data aktivitas staff
        $totalReports = Report::where('staff_id', $user->id)->count();
        $totalBookings = Booking::where('staff_id', $user->id)->count();

        // Kamu belum punya kolom "status" atau "foto", jadi aku isi default
        $staff = [
            'id' => $user->id,
            'nama' => $user->name,
            'jabatan' => 'Staff PlayCare',
            'telepon' => $user->phone ?? '-',
            'alamat' => $user->address ?? '-',
            'email' => $user->email,
            'status' => 'Aktif',
            'foto' => $user->photo
                ? asset('storage/profile_photos/' . $user->photo)
                : 'https://ui-avatars.com/api/?name=' . urlencode($user->name),
            'bergabung_sejak' => $user->created_at->translatedFormat('F Y'),
            'laporan_dibuat' => $totalReports,
            'booking_ditangani' => $totalBookings,
        ];


        return view('staff.profile.index', compact('staff'));
    }

    public function edit($id)
    {
        $staff = Auth::user();

        if ($staff->id != $id) {
            abort(403, 'Tidak diizinkan mengedit profil orang lain.');
        }

        return view('staff.profile.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->id != $id) {
            abort(403, 'Tidak diizinkan mengedit profil orang lain.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);


        // assign manual
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->address = $validated['address'] ?? null;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Hapus foto lama (jika ada)
        if ($user->photo && file_exists(storage_path('app/public/profile_photos/' . $user->photo))) {
            unlink(storage_path('app/public/profile_photos/' . $user->photo));
        }

        // Simpan foto baru
        $filename = time() . '_' . $request->photo->getClientOriginalName();
        $request->photo->storeAs('public/profile_photos', $filename);

        $user->photo = $filename;



        $user->save();

        return redirect()->route('staff.profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
