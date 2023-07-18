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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id()->startingValue(100);
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('offer_id')->constrained('offers')->cascadeOnDelete();
            $table->double('price')->default(0.0);
            $table->enum('status', [1, 2]);
            $table->enum('payment_method', config('data.payment-methods'));
            $table->date('date_from');
            $table->date('date_to');
            $table->string('check_number')->nullable();
            $table->string('recipient_name')->nullable();
            $table->enum('bank', config('data.banks'));
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
