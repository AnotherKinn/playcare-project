<?php

namespace App\Models;

use App\Models\Child;
use App\Models\Booking;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'phone', 'address', 'phone', 'member_since'];

    protected $hidden = ['password'];

    public function children()
    {
        return $this->hasMany(Child::class, 'parent_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'parent_id');
    }

    public function assignedBookings()
    {
        return $this->hasMany(Booking::class, 'staff_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'parent_id');
    }
}
