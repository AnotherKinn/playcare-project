<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('booking')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('staff.notifications.index', compact('notifications'));
    }

    public function show($id)
    {
        $notification = Notification::with('booking')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        switch ($notification->type_notification) {

            case 'assigned_staff':
                return view('staff.notifications.types.assigned_staff', compact('notification'));

            default:
                abort(404);
        }
    }
}
