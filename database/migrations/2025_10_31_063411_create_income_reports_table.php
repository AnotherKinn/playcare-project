<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('income_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->onDelete('cascade');
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->decimal('amount', 10, 2)->nullable(); // jumlah uang yang diterima
            $table->date('transaction_date')->nullable(); // tanggal transaksi
            $table->string('payment_method')->nullable(); // metode pembayaran (Tripay, Cash, dll)
            $table->string('status')->default('completed'); // status pembayaran
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('income_reports');
    }
};
