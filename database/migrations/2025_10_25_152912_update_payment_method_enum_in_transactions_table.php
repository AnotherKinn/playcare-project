<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Hapus kolom lama kalau sebelumnya string
            $table->dropColumn('payment_method');
        });

        Schema::table('transactions', function (Blueprint $table) {
            // Tambahkan ulang sebagai ENUM
            $table->enum('payment_method', ['transfer_bank', 'qris', 'bayar_ditempat'])
                  ->nullable()
                  ->after('booking_id');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });

        Schema::table('transactions', function (Blueprint $table) {
            // Kembalikan ke string seperti semula jika di-rollback
            $table->string('payment_method')->nullable()->after('booking_id');
        });
    }
};
