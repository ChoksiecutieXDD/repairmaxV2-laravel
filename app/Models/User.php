<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * If you decided to keep 'user_id' as your primary key instead of changing 
     * it to 'id', uncomment the line below so Laravel knows what to look for!
     */
    // protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'role',
        'is_verified',
        'verification_token',
        'reset_token',
        'reset_token_expiry',
        'profile_picture',
        'is_active',
        'remember_token',
        // Consolidated Fields
        'bio',
        'date_of_birth',
        'gender',
        'alternative_phone',
        'emergency_contact',
        'email_notifications',
        'sms_notifications',
        'push_notifications',
        'status',
        'suspension_reason',
        'suspended_at',
        'preferred_language',
        'timezone',
        'last_login_ip',
        'last_login_at',
        'admin_level',
        'permissions',
        'department',
        'job_title',
        'admin_notes',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token', // Kept for Laravel's built-in "Remember Me" login feature
        'verification_token',
        'reset_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
            'is_active' => 'boolean',
            'reset_token_expiry' => 'datetime',
            'date_of_birth' => 'date',
            'suspended_at' => 'datetime',
            'last_login_at' => 'datetime',
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'push_notifications' => 'boolean',
            'permissions' => 'array',
        ];
    }
    // Relationships
    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function sentNotifications()
    {
        return $this->hasMany(Notification::class, 'admin_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(AdminActivityLog::class, 'admin_id');
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getUnreadNotificationsCount()
    {
        return $this->notifications()->where('is_read', false)->count();
    }
}
