<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // From user_profiles
            $table->string('bio', 500)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('alternative_phone')->nullable();
            $table->string('emergency_contact')->nullable();
            
            // Notifications
            $table->boolean('email_notifications')->default(true);
            $table->boolean('sms_notifications')->default(false);
            $table->boolean('push_notifications')->default(true);
            
            // Status & Admin Fields
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->text('suspension_reason')->nullable();
            $table->timestamp('suspended_at')->nullable();
            
            // Preferences
            $table->string('preferred_language')->default('en');
            $table->string('timezone')->default('UTC');
            
            // Metadata
            $table->string('last_login_ip')->nullable();
            $table->timestamp('last_login_at')->nullable();

            // From admin_profiles
            $table->enum('admin_level', ['super_admin', 'admin', 'moderator'])->nullable();
            $table->text('permissions')->nullable(); // JSON string
            $table->string('department')->nullable();
            $table->string('job_title')->nullable();
            $table->text('admin_notes')->nullable();
        });

        // Move data from user_profiles to users
        if (Schema::hasTable('user_profiles')) {
            $userProfiles = DB::table('user_profiles')->get();
            foreach ($userProfiles as $profile) {
                DB::table('users')->where('id', $profile->user_id)->update([
                    'bio' => $profile->bio,
                    'date_of_birth' => $profile->date_of_birth,
                    'gender' => $profile->gender,
                    'alternative_phone' => $profile->alternative_phone,
                    'emergency_contact' => $profile->emergency_contact,
                    'email_notifications' => $profile->email_notifications,
                    'sms_notifications' => $profile->sms_notifications,
                    'push_notifications' => $profile->push_notifications,
                    'status' => $profile->status,
                    'suspension_reason' => $profile->suspension_reason,
                    'suspended_at' => $profile->suspended_at,
                    'preferred_language' => $profile->preferred_language,
                    'timezone' => $profile->timezone,
                    'last_login_ip' => $profile->last_login_ip,
                    'last_login_at' => $profile->last_login_at,
                ]);
            }
        }

        // Move data from admin_profiles to users
        if (Schema::hasTable('admin_profiles')) {
            $adminProfiles = DB::table('admin_profiles')->get();
            foreach ($adminProfiles as $profile) {
                DB::table('users')->where('id', $profile->user_id)->update([
                    'admin_level' => $profile->admin_level,
                    'permissions' => $profile->permissions,
                    'department' => $profile->department,
                    'job_title' => $profile->job_title,
                    'admin_notes' => $profile->notes,
                ]);
            }
        }

        // Drop the old tables
        Schema::dropIfExists('user_profiles');
        Schema::dropIfExists('admin_profiles');
    }

    public function down(): void
    {
        // This is a destructive migration, but we can re-create the tables if needed.
        // However, moving data back is complex. 
        // For simplicity, we just drop the columns from users.
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio', 'date_of_birth', 'gender', 'alternative_phone', 'emergency_contact',
                'email_notifications', 'sms_notifications', 'push_notifications',
                'status', 'suspension_reason', 'suspended_at',
                'preferred_language', 'timezone', 'last_login_ip', 'last_login_at',
                'admin_level', 'permissions', 'department', 'job_title', 'admin_notes'
            ]);
        });
    }
};
