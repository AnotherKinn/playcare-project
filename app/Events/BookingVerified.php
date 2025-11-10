<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingVerified implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $parentId;
    public $status;
    public $message;

    public function __construct($parentId, $status, $message)
    {
        $this->parentId = $parentId;
        $this->status = $status;
        $this->message = $message;
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('parent.' . $this->parentId);
    }

    public function broadcastAs(): string
    {
        return 'BookingVerified';
    }
}
