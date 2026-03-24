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
            // Laravel strongly prefers 'id' over 'user_id' for primary keys. 
            // Using $table->id() makes establishing database relationships much easier later!
            $table->id();

            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 100)->unique();
            $table->string('phone', 15)->nullable();
            $table->string('password');
            $table->text('address')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('postal_code', 10)->nullable();

            $table->enum('role', ['user', 'admin'])->default('user');

            $table->boolean('is_verified')->default(0);
            $table->string('verification_token')->nullable();

            // Laravel handles password resets in a separate table by default, 
            // but we can keep your columns here if you prefer your custom logic!
            $table->string('reset_token')->nullable();
            $table->dateTime('reset_token_expiry')->nullable();

            $table->string('profile_picture')->nullable();
            $table->boolean('is_active')->default(1);

            // This automatically creates both your 'created_at' and 'updated_at' timestamp columns
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
