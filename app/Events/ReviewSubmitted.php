<?php

namespace App\Events;

use App\Models\Review;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ReviewSubmitted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function broadcastOn(): array
    {
        // Channel publik untuk admin
        return [new Channel('admin.notifications')];
    }

    public function broadcastAs(): string
    {
        // Nama event yang akan didengar di Echo
        return 'review.submitted';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->review->id,
            'parent_name' => $this->review->parent->name ?? 'Parent tidak diketahui',
            'rating' => $this->review->rating,
            'comment' => $this->review->comment,
            'feedback_catogory' => $this->review->feedback_category,
            'created_at' => $this->review->created_at->diffForHumans(),
        ];
    }

}

