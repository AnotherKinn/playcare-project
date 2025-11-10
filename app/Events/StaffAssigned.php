<?php

namespace App\Events;

use App\Models\Booking;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StaffAssigned implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $booking;
    public $adminName;

    /**
     * Create a new event instance.
     */
    public function __construct(Booking $booking, $adminName)
    {
        $this->booking = $booking;
        $this->adminName = $adminName;
    }

    /**
     * Tentukan channel tempat event disiarkan.
     */
    public function broadcastOn()
    {
        // channel private untuk staff yang ditugaskan
        return new PrivateChannel('staff.' . $this->booking->staff_id);
    }

    /**
     * Nama event yang disiarkan ke frontend
     */
    public function broadcastAs()
    {
        return 'staff.assigned';
    }
}
