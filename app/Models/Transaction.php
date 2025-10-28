<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'payment_method', 'transaction_code', 'amount', 'status', 'proof', 'paid_at'];

    public function booking() {
        return $this->belongsTo(Booking::class);
    }
}
