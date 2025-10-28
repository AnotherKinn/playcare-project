<?php

namespace App\Models;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id', 'booking_id', 'start_date', 'end_date', 'status'];

    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function booking() {
        return $this->belongsTo(Booking::class);
    }
}
