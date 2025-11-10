<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Ubah kolom status jadi ENUM
            DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('pending', 'pending_verification', 'success', 'failed') DEFAULT 'pending'");
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Kembalikan ke string (jika rollback)
            DB::statement("ALTER TABLE transactions MODIFY COLUMN status VARCHAR(255) DEFAULT 'pending'");
        });
    }
};
