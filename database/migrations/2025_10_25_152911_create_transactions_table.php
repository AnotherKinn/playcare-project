<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('payment_method')->default('manual'); // contoh: cash / transfer bank / e-wallet simulasi
            $table->string('transaction_code')->nullable(); // kode unik simulasi (bisa auto generate)
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'failed'])->default('pending');
            $table->text('proof')->nullable(); // bisa simpan path bukti transfer (jika perlu upload gambar)
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('transactions');
    }
};
