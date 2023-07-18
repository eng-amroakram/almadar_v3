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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            //Relation Ships
            $table->foreignId('user_id')->nullable()->constrained("users")->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained("cities")->nullOnDelete();
            $table->foreignId('neighborhood_id')->nullable()->constrained("neighborhoods")->nullOnDelete();
            $table->foreignId('nationality_id')->nullable()->constrained("nationalities")->nullOnDelete();

            //Fields
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('id_number_type')->nullable();
            $table->string('id_number')->nullable()->unique();
            $table->string('description')->nullable();
            $table->string('employer')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('building_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('neighborhood_name')->nullable();
            $table->enum('employment_type', ["private", "public"])->nullable();
            $table->string('extra_figure')->nullable();
            $table->string('unit_number')->nullable();
            $table->enum('housing_support', [1, 2])->nullable();
            $table->enum('status', [1, 2])->nullable();
            $table->enum('is_buy', [1, 2])->nullable();

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
        Schema::dropIfExists('clients');
    }
};
