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
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('sale_id')->nullable()->constrained('sales');
            $table->foreignId('seller_id')->nullable()->constrained('clients');
            $table->foreignId('buyer_id')->nullable()->constrained('clients');
            $table->foreignId('offer_id')->nullable()->constrained('offers')->cascadeOnDelete();
            $table->foreignId('reservation_id')->nullable()->constrained('reservations')->cascadeOnDelete();

            $table->decimal('amount', 10, 2);

            $table->enum('payment_method', config('data.payment-methods'));
            $table->string('check_number')->nullable();
            $table->string('recipient_name')->nullable();
            $table->enum('bank', config('data.banks'))->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_payments');
    }
};
