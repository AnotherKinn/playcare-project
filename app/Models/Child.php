<?php

namespace App\Models;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'name', 'age', 'gender', 'allergy', 'notes'];

    public function parent() {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
