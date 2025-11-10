<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staff_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->date('report_date');
            $table->text('activity')->nullable();               // Child's daily activity description
            $table->enum('child_condition', ['GD', 'CR', 'SK', 'NA'])->default('GD');
            $table->text('notes')->nullable();                  // Additional notes from the staff
            $table->string('meal')->nullable();                 // What the child ate
            $table->string('sleep_duration')->nullable();       // Example: "1h 20m"
            $table->enum('status', ['CP', 'NF', 'PR', 'IP'])->default('PR');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_reports');
    }
};
