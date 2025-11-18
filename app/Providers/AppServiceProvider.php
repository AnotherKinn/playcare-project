<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // View composer untuk navbar mini
        View::composer('layouts.navbar-mini', \App\View\Composers\NotificationComposer::class);

        // View composer untuk sidebar admin
        // View::composer('layouts.sidebar-admin', function ($view) {
        //     // Ambil semua notifikasi admin terbaru
        //     $notifications = Notification::with(['booking.child', 'transaction'])
        //         ->latest()
        //         ->get();

        //     // Filter manual sesuai kondisi di halaman notifications/index.blade.php
        //     $notifCount = $notifications->filter(function ($notif) {
        //         $booking = $notif->booking;
        //         $transaction = $notif->transaction;

        //         return match ($notif->type_notification) {
        //             'booking_created' => $booking && $transaction
        //                 && $booking->status === 'pending'
        //                 && $transaction->status === 'pending_verification',

        //             'information' => $booking && in_array($booking->status, ['approved', 'cancelled']),

        //             'report_child' => true,

        //             'pick_up_children' => true,

        //             'review_parent' => true,

        //             default => false,
        //         };
        //     })->count();

        //     $view->with('notifCount', $notifCount);
        // });

        View::composer('layouts.nav-staff', function ($view) {
            $user = Auth::user();
            $notifCount = 0;

            if ($user) {
                // contoh sederhana: hitung notifikasi yang ditujukan ke staff (user_id)
                $notifCount = Notification::where('user_id', $user->id)->count();

                // atau kalau logika notifikasi kamu berbeda (mis. type 'assigned_staff' dan booking.staff_id)
                // $notifCount = Notification::where(function($q) use($user) {
                //     $q->where('user_id', $user->id)
                //       ->orWhere(function($q2) use($user) {
                //           $q2->where('type_notification', 'assigned_staff')
                //              ->whereHas('booking', fn($b) => $b->where('staff_id', $user->id));
                //       });
                // })->count();
            }

            $view->with('notifCount', $notifCount);
        });


        View::composer('layouts.navbar-mini-admin', function ($view) {
            $isAdmin = Auth::user()->role === 'admin';
            $notifCount = 0;

            if ($isAdmin) {
                // Ambil semua notifikasi admin terbaru
                $notifications = Notification::with(['booking.child', 'transaction'])
                    ->latest()
                    ->get();

                // Filter manual sesuai kondisi di halaman notifications/index.blade.php
                $notifCount = $notifications->filter(function ($notif) {
                    $booking = $notif->booking;
                    $transaction = $notif->transaction;

                    return match ($notif->type_notification) {
                        'booking_created' => $booking && $transaction
                            && $booking->status === 'pending'
                            && $transaction->status === 'pending_verification',

                        'information' => $booking && in_array($booking->status, ['approved', 'cancelled']),

                        'report_child' => true,

                        'pick_up_children' => true,

                        'review_parent' => true,

                        default => false,
                    };
                })->count();
            }

            $view->with('notifCount', $notifCount);
        });
    }
}
