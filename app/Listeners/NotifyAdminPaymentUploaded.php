<?php

namespace App\Listeners;

use App\Events\PaymentUploaded;
use App\Models\Notification;
use App\Models\User;

class NotifyAdminPaymentUploaded
{
    public function handle(PaymentUploaded $event): void
    {
        // Cari semua user dengan role admin
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'type_notification' => 'booking_created',
                'booking_id' => $event->transaction->booking_id,
                'transaction_id' => $event->transaction->id,
            ]);
        }
    }
}
