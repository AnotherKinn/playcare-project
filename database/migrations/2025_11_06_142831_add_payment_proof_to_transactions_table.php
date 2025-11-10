<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Kolom untuk menyimpan path bukti pembayaran
            $table->string('payment_proof')->nullable()->after('status');

            // Ubah status menjadi enum atau string dengan nilai baru (optional tergantung struktur awal)
            $table->string('status')->default('pending')->change();

            $table->dropColumn('proof');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('payment_proof');
            $table->text('proof');
        });
    }
};
