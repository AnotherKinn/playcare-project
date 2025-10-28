<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with('children')->find(Auth::id()); // ambil data user + relasi anak
        return view('parent.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('parent.profile.edit', compact('user'));
    }

    /** @var \App\Models\User $user */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            // tambahkan webp jika perlu
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // handle foto (cek hasFile dan file valid)
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            // hapus foto lama (disk public)
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // simpan file baru
            $photoPath = $request->file('photo')->store('photos', 'public');
            $user->photo = $photoPath;
        }

        // assign fields secara eksplisit
        $user->name = $validated['name'];
        $user->phone = $validated['phone'] ?? null;
        $user->address = $validated['address'] ?? null;

        $user->save();

        return redirect()->route('parent.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
