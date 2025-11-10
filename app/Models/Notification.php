<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model

{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'booking_id',
        'transaction_id',
        'type_notification',
        'review_id'
    ];

    /**
     * 🔗 Relasi ke model User (penerima notifikasi)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 🔗 Relasi ke model Booking (jika notifikasi berhubungan dengan booking)
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * 🔗 Relasi ke model Transaction (jika notifikasi berhubungan dengan transaksi)
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * 🧠 Scope untuk ambil notifikasi berdasarkan user login
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId)->latest();
    }

    /**
     * 🧠 Scope untuk filter berdasarkan tipe notifikasi
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type_notification', $type);
    }

    /**
     * 🔗 Relasi ke model Review (jika notifikasi berhubungan dengan review)
     */
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
