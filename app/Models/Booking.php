<?php

namespace App\Models;

use App\Models\User;
use App\Models\Child;
use App\Models\Transaction;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'child_id',
        'time_type',
        'duration',
        'booking_date',
        'child_photo',
        'notes',
        'total_price',
        'status'
    ];

    protected $casts = [
        'date' => 'date',
        'booking_date' => 'datetime'
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function assignedStaff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }


    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
