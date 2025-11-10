<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom foto ke tabel reports.
     */
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('notes');
            // 'after' bisa disesuaikan sama nama kolom terakhir kamu sebelumnya
        });
    }

    /**
     * Hapus kolom foto saat rollback.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }
};
