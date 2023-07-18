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
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->integer('floor')->nullable();
            $table->integer('floors')->nullable();
            $table->integer('flats')->nullable();
            $table->integer('flat_rooms')->nullable();
            $table->integer('rooms')->nullable();
            $table->integer('stores')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('interface_length')->nullable();
            $table->integer('age')->nullable();

            $table->double('annual_income')->nullable();
            $table->double('space')->nullable();
            $table->double('total')->nullable();
            $table->double('price')->nullable();
            $table->double('price_meter')->nullable();

            $table->text('notes')->nullable();

            $table->string('land_number')->nullable();
            $table->string('statement')->nullable();
            $table->string('character')->nullable();
            $table->string('block_number')->nullable();

            $table->enum('real_estate_type', config('data.real_estate_types'))->nullable();
            $table->enum('property_status', config('data.real_estate_location.property_statuses'))->nullable();

            $table->foreignId('creator')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updater')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estates');
    }
};
