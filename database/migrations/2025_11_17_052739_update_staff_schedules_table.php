<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('staff_schedules', function (Blueprint $table) {
            // Hapus kolom yang tidak dibutuhkan
            if (Schema::hasColumn('staff_schedules', 'start_date')) {
                $table->dropColumn('start_date');
            }
            if (Schema::hasColumn('staff_schedules', 'end_date')) {
                $table->dropColumn('end_date');
            }

            // Ubah kolom status
            $table->enum('status', ['active', 'assigned', 'non-active'])
                  ->default('active')
                  ->change();
        });
    }

    public function down(): void {
        Schema::table('staff_schedules', function (Blueprint $table) {
            // Kembalikan kolom start_date & end_date
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Kembalikan status lama
            $table->enum('status', ['active', 'done', 'cancelled'])->default('active')->change();
        });
    }
};
