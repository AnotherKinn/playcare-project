<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Parent yang memberi review (relasi ke user)
            $table->foreignId('parent_id')->constrained('users')->onDelete('cascade');

            // Relasi opsional ke booking
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->onDelete('set null');

            // Enum service type sama kayak di tabel booking
            $table->enum('service_type', ['full_day', 'half_day', 'playground'])->default('full_day');

            // Rating 1–5
            $table->unsignedTinyInteger('rating');

            // Komentar
            $table->text('comment');

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('reviews');
    }
};
