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
        Schema::create('chatbot_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->default('New Chat');
            $table->timestamps();
        });

        Schema::create('chatbot_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chatbot_session_id')->constrained('chatbot_sessions')->onDelete('cascade');
            $table->enum('role', ['user', 'assistant']);
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chatbot_messages');
        Schema::dropIfExists('chatbot_sessions');
    }
};
