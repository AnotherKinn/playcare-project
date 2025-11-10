<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Ubah nilai lama ke sementara agar tidak konflik dengan ENUM baru
        DB::table('bookings')->where('status', 'menunggu')->update(['status' => 'pending']);
        DB::table('bookings')->where('status', 'disetujui')->update(['status' => 'approved']);
        DB::table('bookings')->where('status', 'ditolak')->update(['status' => 'cancelled']);

        // Drop kolom status lama
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Tambahkan kolom status baru dengan enum yang lebih profesional
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('status', [
                'pending',      // baru dibuat oleh parent, menunggu admin
                'approved',     // disetujui oleh admin
                'assigned',     // sudah ditugaskan ke staff
                'in_progress',  // sedang dikerjakan oleh staff
                'completed',    // tugas selesai
                'cancelled'     // dibatalkan (opsional)
            ])->default('pending')->after('total_price');
        });
    }

    public function down(): void
    {
        // Rollback ke enum lama
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu')->after('total_price');
        });

        // Kembalikan nilai status ke versi lama
        DB::table('bookings')->where('status', 'pending')->update(['status' => 'menunggu']);
        DB::table('bookings')->where('status', 'approved')->update(['status' => 'disetujui']);
        DB::table('bookings')->where('status', 'cancelled')->update(['status' => 'ditolak']);
    }
};
