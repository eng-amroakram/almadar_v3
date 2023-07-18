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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_code')->unique()->nullable();
            $table->foreignId('offer_id')->constrained('offers')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('seller_id')->constrained('clients');
            $table->foreignId('buyer_id')->constrained('clients');

            $table->foreignId('real_estate_id')->constrained('real_estates')->cascadeOnDelete();
            $table->foreignId('broker_id')->nullable()->constrained('brokers');

            $table->double('real_estate_price')->nullable()->default(0.0);

            $table->enum('is_first_home', [1, 2]);
            $table->double('deserved_amount')->nullable()->default(0.0);
            $table->double('commission_vat')->nullable()->default(0.0);

            $table->enum('commission_type', ["percentage", "price"]);
            $table->double('commission_percentage')->nullable()->default(0.0);
            $table->double('commission_price')->nullable()->default(0.0);

            $table->double('amount_paid')->nullable()->default(0.0);
            $table->double('total_amount')->nullable()->default(0.0);

            $table->enum('payment_method', config('data.payment-methods'));
            $table->string('check_number')->nullable();
            $table->string('recipient_name')->nullable();
            $table->enum('bank', config('data.banks'))->nullable();


            $table->enum('status', [1, 2]);

            $table->text('note')->nullable();

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
        Schema::dropIfExists('sales');
    }
};
