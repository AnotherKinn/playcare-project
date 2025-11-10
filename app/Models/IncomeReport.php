<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'month',
        'year',
        'amount',
        'transaction_date',
        'payment_method',
        'status',
    ];

    /**
     * Relasi ke tabel bookings
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
