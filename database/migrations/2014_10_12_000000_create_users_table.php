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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('user_status', ['active', 'inactive', 'blocked']);
            $table->enum('user_type', ['superadmin', 'admin', 'office', 'marketer']);
            $table->integer('verification_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('advertiser_number')->nullable();
            $table->json('permissions');


            $table->foreignId('creator')->nullable()->constrained("users")->cascadeOnDelete();
            $table->foreignId('updater')->nullable()->constrained("users")->cascadeOnDelete();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
