<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Child;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('child')
            ->where('parent_id', Auth::id())
            ->get();

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
            'service_type' => 'required|in:full_day,half_day,playground',
            'booking_date' => 'required|date',
            'duration_hours' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        // 💰 Logika harga booking
        $hourlyRate = 25000;
        $fullDayRate = 180000;

        if ($request->duration_hours < 24) {
            $totalPrice = $request->duration_hours * $hourlyRate;
        } elseif ($request->duration_hours == 24) {
            $totalPrice = $fullDayRate;
        } else {
            $extraHours = $request->duration_hours - 24;
            $totalPrice = $fullDayRate + ($extraHours * $hourlyRate);
        }

        // 🧾 Buat booking
        $booking = Booking::create([
            'parent_id' => Auth::id(),
            'child_id' => $request->child_id,
            'service_type' => $request->service_type,
            'duration_hours' => $request->duration_hours,
            'booking_date' => $request->booking_date,
            'notes' => $request->notes,
            'total_price' => $totalPrice,
            'status' => 'menunggu',
        ]);

        // 💳 Buat transaksi dengan status pending
        $transaction = Transaction::create([
            'booking_id' => $booking->id,
            'payment_method' => null, // dipilih nanti di halaman pembayaran
            'amount' => $totalPrice,
            'status' => 'pending',
        ]);

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
        $booking = Booking::with('child')
            ->where('parent_id', Auth::id())
            ->findOrFail($id);

        $request->validate([
            'child_id' => 'required|exists:children,id',
            'service_type' => 'required|in:full_day,half_day,playground',
            'booking_date' => 'required|date',
            'duration_hours' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        // 💰 Logika harga booking (sama seperti di store)
        $hourlyRate = 25000;
        $fullDayRate = 180000;

        if ($request->duration_hours < 24) {
            $totalPrice = $request->duration_hours * $hourlyRate;
        } elseif ($request->duration_hours == 24) {
            $totalPrice = $fullDayRate;
        } else {
            $extraHours = $request->duration_hours - 24;
            $totalPrice = $fullDayRate + ($extraHours * $hourlyRate);
        }

        $booking->update([
            'child_id' => $request->child_id,
            'service_type' => $request->service_type,
            'duration_hours' => $request->duration_hours,
            'booking_date' => $request->booking_date,
            'notes' => $request->notes,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('parent.booking.index')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $booking = Booking::with('child')
            ->where('parent_id', Auth::id())
            ->findOrFail($id);

        $booking->delete();

        return redirect()->route('parent.booking.index')
            ->with('success', 'Booking berhasil dihapus.');
    }
}
