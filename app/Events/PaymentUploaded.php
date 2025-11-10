<?php

namespace App\Events;

use App\Models\Transaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentUploaded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $transaction;

    public function __construct(Transaction $transaction)
    {
        // Pastikan relasi 'user' diload sebelum dikirim
        $this->transaction = $transaction->load('user');
    }

    public function broadcastOn(): Channel
    {
        return new Channel('admin.notifications'); // channel publik kamu
    }

    public function broadcastAs(): string
    {
        return 'payment.uploaded';
    }
}
