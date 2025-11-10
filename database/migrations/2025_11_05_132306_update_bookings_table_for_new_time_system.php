<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Hapus kolom lama
            if (Schema::hasColumn('bookings', 'service_type')) {
                $table->dropColumn('service_type');
            }
            if (Schema::hasColumn('bookings', 'duration_hours')) {
                $table->dropColumn('duration_hours');
            }

            // Tambah kolom baru
            $table->enum('time_type', ['per_jam', 'per_hari', 'per_bulan'])->default('per_jam')->after('child_id');
            $table->integer('duration')->nullable()->after('time_type'); // untuk durasi jam (jika per_jam)
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // rollback ke struktur lama
            if (Schema::hasColumn('bookings', 'time_type')) {
                $table->dropColumn(['time_type', 'duration']);
            }

            $table->enum('service_type', ['full_day', 'half_day', 'playground'])->default('full_day');
            $table->integer('duration_hours')->nullable();
        });
    }
};
