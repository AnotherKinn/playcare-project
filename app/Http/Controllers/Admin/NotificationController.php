<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * 🔔 Menampilkan semua notifikasi untuk admin
     */
    public function index()
    {
        // $notifications = Notification::with(['booking', 'transaction', 'booking.parent'])
        //     ->where('type_notification', '!=', 'greeting') // contoh filter
        //     ->latest()
        //     ->get();
        $notifications = Notification::latest()->get()->unique(fn($item) => $item->booking_id . '-' . $item->transaction_id);


        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * 📄 Menampilkan detail notifikasi berdasarkan tipe.
     */
    public function show($id)
    {
        $notification = Notification::with([
            'booking',
            'transaction',
            'booking.parent',
            'review.parent',
            'review.booking'
        ])->findOrFail($id);


        switch ($notification->type_notification) {
            case 'booking_created':
                return view('admin.notifications.types.booking_created', compact('notification'));

            case 'report_child':
                return view('admin.notifications.types.report_child', compact('notification'));

            case 'pick_up_children':
                return view('admin.notifications.types.pick_up_children', compact('notification'));

            case 'review_parent':
                return view('admin.notifications.types.review_parent', compact('notification'));

            default:
                abort(404, 'Tipe notifikasi tidak dikenali.');
        }
    }

    /**
     * 🗑️ Hapus notifikasi
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notifikasi berhasil dihapus.');
    }
}
