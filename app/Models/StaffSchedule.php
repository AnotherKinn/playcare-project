<?php

namespace App\Models;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id', 'booking_id', 'status'];

    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function booking() {
        return $this->belongsTo(Booking::class);
    }

      // relasi ke semua jadwal staff
    public function staffSchedules()
    {
        return $this->hasMany(StaffSchedule::class, 'staff_id');
    }

    // ambil schedule terbaru
    public function latestSchedule()
    {
        return $this->hasOne(StaffSchedule::class, 'staff_id')->latestOfMany();
    }
}
