<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'booking_id',
        'report_date',
        'activity',
        'child_condition',
        'notes',
        'meal',
        'sleep_duration',
        'status',
    ];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Accessors untuk label enum (biar enak ditampilkan di blade)
    public function getStatusLabelAttribute()
    {
        return [
            'CP' => 'Completed',
            'NF' => 'Needs follow-up',
            'PR' => 'Pending review',
            'IP' => 'In progress',
        ][$this->status] ?? 'Unknown';
    }

    public function getChildConditionLabelAttribute()
    {
        return [
            'GD' => 'Good',
            'CR' => 'Cranky',
            'SK' => 'Sick',
            'NA' => 'Needs attention',
        ][$this->child_condition] ?? 'Unknown';
    }
}
