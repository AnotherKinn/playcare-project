<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'booking_id',
        'rating',
        'comment',
        'feedback_category'
    ];

    // Relasi ke parent (user)
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    // Relasi ke booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
