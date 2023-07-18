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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->foreignId('real_estate_id')->nullable()->constrained('real_estates')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->json('brokers_ids')->nullable();

            $table->string('offer_code')->unique()->nullable();
            $table->enum('offer_type', config('data.offer-types'));
            $table->enum('status', [1, 2]);

            $table->foreignId('creator')->nullable()->constrained("users")->nullOnDelete();
            $table->foreignId('updater')->nullable()->constrained("users")->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
