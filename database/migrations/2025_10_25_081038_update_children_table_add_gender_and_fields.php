<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('children', function (Blueprint $table) {
            // Tambah kolom gender kalau belum ada
            if (!Schema::hasColumn('children', 'gender')) {
                $table->enum('gender', ['Laki-laki', 'Perempuan'])->after('age');
            }

            // Pastikan allergy dan notes bisa null (kalau sebelumnya belum)
            $table->string('allergy')->nullable()->change();
            $table->text('notes')->nullable()->change();
        });
    }

    public function down(): void {
        Schema::table('children', function (Blueprint $table) {
            // Rollback kolom gender jika perlu
            if (Schema::hasColumn('children', 'gender')) {
                $table->dropColumn('gender');
            }
        });
    }
};
