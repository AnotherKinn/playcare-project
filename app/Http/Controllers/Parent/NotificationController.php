<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * 🔔 Menampilkan semua notifikasi milik parent yang login.
     */
    public function index()
    {
        $notifications = Notification::with(['booking', 'transaction'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('parent.notifications.index', compact('notifications'));
    }

    /**
     * 📄 Menampilkan detail notifikasi berdasarkan tipe notifikasi.
     */
    public function show($id)
    {
        $notification = Notification::with(['booking', 'transaction'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        // Arahkan ke view berbeda sesuai type_notification
        switch ($notification->type_notification) {
            case 'information':
                return view('parent.notifications.types.information', compact('notification'));

            case 'booking_created':
                return view('parent.notifications.types.booking_created', compact('notification'));

            case 'assigned_staff':
                return view('parent.notifications.types.assigned_staff', compact('notification'));

            case 'report_child':
                return view('parent.notifications.types.report_child', compact('notification'));

            case 'pick_up_children':
                return view('parent.notifications.types.pick_up_children', compact('notification'));

            case 'review_parent':
                return view('parent.notifications.types.review_parent', compact('notification'));

            case 'greeting':
                return view('parent.notifications.types.greeting', compact('notification'));

            default:
                abort(404);
        }
    }

    public function destroy($id)
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($id);

        $notification->delete();

        return redirect()
            ->route('parent.notifications.index')
            ->with('success', '✅ Notifikasi berhasil dihapus.');
    }
}
