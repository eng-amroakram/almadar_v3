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
        Schema::create('real_estate_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->foreignId('neighborhood_id')->nullable()->constrained('neighborhoods')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('real_estate_id')->nullable()->constrained('real_estates');

            $table->enum('land_type', config('data.real_estate_location.land_types'))->nullable();
            // $table->enum('interface_length', config('data.real_estate_location.interface_lengths'))->nullable();
            $table->enum('owner_ship_type', config('data.real_estate_location.owner_ship_types'))->nullable();
            $table->enum('building_type', config('data.real_estate_location.building_types'))->nullable();
            $table->enum('building_status', config('data.real_estate_location.building_statuses'))->nullable();
            $table->enum('construction_delivery', config('data.real_estate_location.construction_deliveries'))->nullable();
            $table->enum('property_type', config('data.real_estate_types'))->nullable();
            $table->enum('licensed', config('data.real_estate_location.licensed'))->nullable();

            $table->json('street_width')->nullable();
            $table->json('directions')->nullable();

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
        Schema::dropIfExists('real_estate_locations');
    }
};
