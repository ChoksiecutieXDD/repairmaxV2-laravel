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
        if (Schema::hasTable('chatbot_messages')) {
            // Table already exists from 2026_05_10_094956_create_chatbot_tables
            // We need to modify it to add message, is_user, metadata and migrate data
            Schema::table('chatbot_messages', function (Blueprint $table) {
                if (!Schema::hasColumn('chatbot_messages', 'metadata')) {
                    $table->json('metadata')->nullable();
                }
                if (!Schema::hasColumn('chatbot_messages', 'is_user')) {
                    $table->boolean('is_user')->default(false);
                }
                if (!Schema::hasColumn('chatbot_messages', 'message')) {
                    $table->longText('message')->nullable(); // nullable temporarily
                }
            });

            // Migrate data from role/content to is_user/message
            if (Schema::hasColumn('chatbot_messages', 'role') && Schema::hasColumn('chatbot_messages', 'content')) {
                \DB::table('chatbot_messages')->chunkById(100, function ($messages) {
                    foreach ($messages as $msg) {
                        \DB::table('chatbot_messages')
                            ->where('id', $msg->id)
                            ->update([
                                'message' => $msg->content,
                                'is_user' => $msg->role === 'user' ? 1 : 0,
                            ]);
                    }
                });

                // Now drop the old columns and make message column not nullable
                Schema::table('chatbot_messages', function (Blueprint $table) {
                    $table->dropColumn(['role', 'content']);
                    $table->longText('message')->nullable(false)->change();
                });
            }
            
            Schema::table('chatbot_messages', function (Blueprint $table) {
                $table->index(['chatbot_session_id', 'created_at']);
            });
        } else {
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('chatbot_messages')) {
            if (!Schema::hasColumn('chatbot_messages', 'content')) {
                Schema::table('chatbot_messages', function (Blueprint $table) {
                    $table->text('content')->nullable();
                    $table->enum('role', ['user', 'assistant'])->default('user');
                });

                \DB::table('chatbot_messages')->chunkById(100, function ($messages) {
                    foreach ($messages as $msg) {
                        \DB::table('chatbot_messages')
                            ->where('id', $msg->id)
                            ->update([
                                'content' => $msg->message,
                                'role' => $msg->is_user ? 'user' : 'assistant',
                            ]);
                    }
                });

                Schema::table('chatbot_messages', function (Blueprint $table) {
                    $table->dropColumn(['message', 'is_user', 'metadata']);
                    $table->text('content')->nullable(false)->change();
                });
            }
        } else {
            Schema::dropIfExists('chatbot_messages');
        }
    }
};
