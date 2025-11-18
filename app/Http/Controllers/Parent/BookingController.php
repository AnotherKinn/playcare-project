<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Child;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('child')
            ->where('parent_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('parent.booking.index', compact('bookings'));
    }

    public function create()
    {
        $children = Child::where('parent_id', Auth::id())->get();
        return view('parent.booking.create', compact('children'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
            'time_type' => 'required|in:per_jam,per_hari,per_bulan',
            'booking_date' => 'required|date',
            'duration' => 'nullable|integer|min:1',
            'notes' => 'nullable|string',
            'child_photo' => 'nullable|image|max:2048', // ➕ Tambahan validasi foto
        ]);

        $photoPath = null;

        if ($request->hasFile('child_photo')) {
            $photoPath = $request->file('child_photo')->store('child_photos', 'public');
        }


        // 💰 Tarif baru
        $perHourRate = 50000;
        $perDayRate = 200000;
        $perMonthRate = 2250000;

        // 🔢 Hitung total harga
        switch ($request->time_type) {
            case 'per_jam':
                $totalPrice = $request->duration * $perHourRate;
                break;
            case 'per_hari':
                $totalPrice = $perDayRate;
                break;
            case 'per_bulan':
                $totalPrice = $perMonthRate;
                break;
            default:
                $totalPrice = 0;
                break;
        }

        // 🧾 Buat booking baru
        $booking = Booking::create([
            'parent_id' => Auth::id(),
            'child_id' => $request->child_id,
            'time_type' => $request->time_type,
            'duration' => $request->duration,
            'booking_date' => $request->booking_date,
            'notes' => $request->notes,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'child_photo' => $photoPath, // ➕ Tambahan
        ]);


        // 💳 Buat transaksi otomatis
        Transaction::create([
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'payment_method' => null,
            'amount' => $totalPrice,
            'status' => 'pending',
        ]);

        Log::info('Booking baru dibuat berdasarkan sistem waktu.');

        return redirect()->route('parent.payments.create', ['booking_id' => $booking->id])
            ->with('success', 'Booking berhasil dibuat. Silakan lanjut ke pembayaran.');
    }

    public function edit($id)
    {
        $booking = Booking::with('child')
            ->where('parent_id', Auth::id())
            ->findOrFail($id);

        $children = Child::where('parent_id', Auth::id())->get();

        return view('parent.booking.edit', compact('booking', 'children'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::where('parent_id', Auth::id())->findOrFail($id);

        $request->validate([
            'child_id' => 'required|exists:children,id',
            'time_type' => 'required|in:per_jam,per_hari,per_bulan',
            'booking_date' => 'required|date',
            'duration' => 'nullable|integer|min:1',
            'notes' => 'nullable|string',
            'child_photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('child_photo')) {
            // delete old file
            if ($booking->child_photo && Storage::disk('public')->exists($booking->child_photo)) {
                Storage::disk('public')->delete($booking->child_photo);
            }

            $booking->child_photo = $request->file('child_photo')->store('child_photos', 'public');
        }


        // 💰 Tarif baru
        $perHourRate = 50000;
        $perDayRate = 200000;
        $perMonthRate = 2250000;

        // 🔢 Hitung ulang harga
        switch ($request->time_type) {
            case 'per_jam':
                $totalPrice = $request->duration * $perHourRate;
                break;
            case 'per_hari':
                $totalPrice = $perDayRate;
                break;
            case 'per_bulan':
                $totalPrice = $perMonthRate;
                break;
            default:
                $totalPrice = 0;
                break;
        }

        $booking->update([
            'child_id' => $request->child_id,
            'time_type' => $request->time_type,
            'duration' => $request->duration,
            'booking_date' => $request->booking_date,
            'notes' => $request->notes,
            'total_price' => $totalPrice,
        ]);

        $booking->save();
        
        return redirect()->route('parent.booking.index')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $booking = Booking::where('parent_id', Auth::id())->findOrFail($id);
        $booking->delete();

        return redirect()->route('parent.booking.index')
            ->with('success', 'Booking berhasil dihapus.');
    }
}
