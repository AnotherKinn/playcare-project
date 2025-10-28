<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::dropIfExists('bookings'); // hapus tabel lama biar gak bentrok

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->enum('service_type', ['full_day', 'half_day', 'playground'])->default('full_day');
            $table->integer('duration_hours')->nullable();
            $table->date('booking_date');
            $table->text('notes')->nullable();
            $table->decimal('total_price', 10, 2)->default(0);
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('bookings');
    }
};
