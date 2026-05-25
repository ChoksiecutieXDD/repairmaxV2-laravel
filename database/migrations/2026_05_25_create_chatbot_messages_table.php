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
        Schema::create('chatbot_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chatbot_session_id')
                ->constrained('chatbot_sessions')
                ->cascadeOnDelete();
            $table->longText('message');
            $table->boolean('is_user')->default(false);
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['chatbot_session_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_messages');
    }
};
