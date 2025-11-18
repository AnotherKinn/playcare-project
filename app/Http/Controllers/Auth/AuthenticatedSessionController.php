<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah email terdaftar
        $user = \App\Models\User::where('email', $request->email)->first();

        if (! $user) {
            return back()->with('loginError', 'Email belum terdaftar. Silakan daftar terlebih dahulu ya 😊');
        }

        // Jika email ada tapi password salah
        if (! \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return back()->with('loginError', 'Password yang kamu masukkan salah, coba lagi ya 😅');
        }

        // Kalau semuanya benar, login
        if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = \Illuminate\Support\Facades\Auth::user();

            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'staff' => redirect()->route('staff.dashboard'),
                'parent' => redirect()->route('parent.dashboard'),
                default => redirect('/'),
            };
        }

        // Fallback (jarang terjadi)
        return back()->with('loginError', 'Terjadi kesalahan saat login, coba beberapa saat lagi.');
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
