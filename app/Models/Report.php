<?php

namespace App\Models;

use App\Models\User;
use App\Models\Child;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id', 'booking_id', 'staff_id', 'meals',
        'sleep', 'activities', 'notes', 'photo','approved_by', 'approved_at'
    ];

    public function child() {
        return $this->belongsTo(Child::class);
    }

    public function booking() {
        return $this->belongsTo(Booking::class);
    }

    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function approver() {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
