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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Customer who made booking
            $table->string('reference_code')->unique(); // Unique booking code
            $table->string('service_name');
            $table->dateTime('booking_date'); // When booking is scheduled
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_method', ['cash'])->default('cash'); // Later can expand to gcash, etc.
            $table->decimal('amount', 10, 2)->default(0.00); // Booking fee
            $table->text('notes')->nullable(); // Special requests or remarks
            $table->boolean('is_paid')->default(false); // Payment status
            $table->dateTime('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
