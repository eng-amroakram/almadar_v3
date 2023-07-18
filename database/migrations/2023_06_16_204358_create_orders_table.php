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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // 订单号
            $table->integer('offer_id')->nullable()->constrained('offers')->nullOnDelete();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->foreignId('neighborhood_id')->nullable()->constrained('neighborhoods')->nullOnDelete();
            $table->foreignId('real_estate_id')->nullable()->constrained('real_estates')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();

            $table->string('order_code')->nullable()->unique();
            $table->double('space');
            $table->double('start_price');
            $table->double('end_price');
            $table->double('amount');
            $table->text('notes')->nullable();

            $table->enum('payment_method', config('data.payment-methods'))->nullable();
            $table->enum('time_purchase', config("data.time-purchases"))->nullable();
            $table->enum('status', config('data.order-statuses'))->nullable();
            $table->enum('property_type', config('data.real_estate_types'))->nullable();

            $table->foreignId('attribution')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('attribution_date')->nullable();
            $table->timestamp('closing')->nullable();

            $table->foreignId('creator')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updater')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('closer')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
