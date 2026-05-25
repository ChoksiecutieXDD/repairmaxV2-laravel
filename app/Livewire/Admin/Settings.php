<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Setting;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.admin')]
#[Title('Settings | Repairmax')]
class Settings extends Component
{
    // Active Navigation Tab (managed via Alpine with entangle for Livewire states)
    public $activeTab = 'overview';

    // General Settings
    public $businessName = 'Repairmax';
    public $businessEmail = 'repairmaxsample@gmail.com';
    public $businessPhone = '+63 2 1234 5678';
    public $businessAddress = '123 Main Street, Business District, City';
    public $businessCity = '';
    public $businessState = '';
    public $businessZipCode = '';
    public $businessWebsite = '';
    public $businessLogo = '';

    // Email Settings
    public $smtpHost = 'smtp.gmail.com';
    public $smtpPort = '587';
    public $smtpUsername = '';
    public $smtpPassword = '';
    public $emailFromAddress = '';
    public $emailFromName = 'Repairmax';
    public $emailNotificationsEnabled = true;

    // Notification Settings
    public $appointmentReminders = true;
    public $appointmentReminderTime = '24'; // hours before
    public $statusUpdateNotifications = true;
    public $adminAlerts = true;

    // Payment Settings
    public $paymentGateway = 'stripe'; // stripe, paypal
    public $stripePublicKey = '';
    public $stripeSecretKey = '';
    public $paypalClientId = '';
    public $paypalClientSecret = '';
    public $currencyCode = 'PHP';
    public $taxPercentage = 0;

    // SMS Settings
    public $smsEnabled = false;
    public $smsTwilioSid = '';
    public $smsTwilioToken = '';
    public $smsFromNumber = '';

    // Business Hours
    public $mondayOpen = '08:00';
    public $mondayClose = '18:00';
    public $tuesdayOpen = '08:00';
    public $tuesdayClose = '18:00';
    public $wednesdayOpen = '08:00';
    public $wednesdayClose = '18:00';
    public $thursdayOpen = '08:00';
    public $thursdayClose = '18:00';
    public $fridayOpen = '08:00';
    public $fridayClose = '18:00';
    public $saturdayOpen = '09:00';
    public $saturdayClose = '16:00';
    public $sundayOpen = '';
    public $sundayClose = '';

    // Security Settings
    public $passwordMinLength = 8;
    public $passwordRequireNumbers = true;
    public $passwordRequireSpecialChars = true;
    public $passwordExpireDays = 90;
    public $twoFactorAuthRequired = false;
    public $sessionTimeout = 60; // minutes
    public $maxLoginAttempts = 5;

    // Integration Settings
    public $googleAnalyticsId = '';
    public $slackWebhookUrl = '';
    public $apiRateLimit = 1000;
    public $apiLoggingEnabled = true;

    // N8N AI Chatbot Configuration
    public $n8nWebhookUrl = '';
    public $n8nWebhookSecret = '';
    public $n8nConnectionStatus = '';
    public $n8nConnectionStatusClass = '';

    // Resources & Queues Configurations
    public $queueDriver = 'database';
    public $sessionDriver = 'database';
    public $cacheStore = 'database';
    public $activeJobsCount = 0;
    public $failedJobsCount = 0;

    // Environment & Security
    public $appEnv = 'local';
    public $appDebug = true;
    public $sslEnabled = false;
    public $appKeyStatus = 'Configured (AES-256)';

    // Health Pulse Metrics
    public $dbSize = '145.2 MB';
    public $dbCapacity = '28%';
    public $averageLatency = '45 ms';
    public $activeSessionsCount = 12;
    public $memoryUsage = '256 MB / 1024 MB';
    public $diskUsage = '32%';

    // General Configuration System Vitals
    public $maintenanceMode = false;
    public $emailNotifications = true;
    public $dataBackup = true;
    public $autoBackupTime = '02:00';
    public $systemVersion = '2.1.0-build.782';

    public function mount()
    {
        $this->loadSystemVitals();
        $this->loadSettings();
    }

    public function loadSettings()
    {
        // Load from database if exists
        $settings = Setting::all()->keyBy('key');
        
        foreach ($settings as $key => $setting) {
            if (property_exists($this, $key)) {
                $this->{$key} = $setting->value;
            }
        }
    }

    public function loadSystemVitals()
    {
        // Load initial settings from config / env helper
        $this->n8nWebhookUrl = env('N8N_WEBHOOK_URL', 'http://localhost:5678/webhook-test/chatbot');
        $this->n8nWebhookSecret = env('N8N_WEBHOOK_SECRET', 'repairmax_secret_123');
        $this->queueDriver = env('QUEUE_CONNECTION', 'database');
        $this->sessionDriver = env('SESSION_DRIVER', 'database');
        $this->cacheStore = env('CACHE_STORE', 'database');
        $this->appEnv = env('APP_ENV', 'local');
        $this->appDebug = (bool) env('APP_DEBUG', true);
        $this->sslEnabled = str_starts_with(url('/'), 'https');

        // Dynamically count jobs
        try {
            $this->activeJobsCount = DB::table('jobs')->count();
            $this->failedJobsCount = DB::table('failed_jobs')->count();
        } catch (\Exception $e) {
            $this->activeJobsCount = 0;
            $this->failedJobsCount = 0;
        }

        // Fetch real-time active sessions
        try {
            $this->activeSessionsCount = DB::table('sessions')->count();
        } catch (\Exception $e) {
            $this->activeSessionsCount = 1;
        }

        // Fetch count of appointments in database as a gauge of size
        try {
            $appointmentCount = Appointment::count();
            $this->dbSize = number_format(($appointmentCount * 0.05) + 1.2, 1) . ' MB';
            $this->dbCapacity = number_format((($appointmentCount * 0.05 + 1.2) / 50.0) * 100, 1) . '%';
        } catch (\Exception $e) {
            $this->dbSize = '1.2 MB';
            $this->dbCapacity = '2%';
        }

        // Dynamically load current maintenance mode status
        $this->maintenanceMode = app()->isDownForMaintenance();
    }

    public function toggleMaintenance()
    {
        $this->maintenanceMode = !$this->maintenanceMode;
        Setting::set('maintenanceMode', $this->maintenanceMode, 'system');
        
        try {
            if ($this->maintenanceMode) {
                Artisan::call('down', [
                    '--secret' => 'repairmax_bypass_key'
                ]);
            } else {
                Artisan::call('up');
            }
        } catch (\Exception $e) {
            Log::error('Artisan maintenance toggle error: ' . $e->getMessage());
        }

        Session::flash('success', 'Maintenance mode ' . ($this->maintenanceMode ? 'enabled' : 'disabled') . ' successfully!');
    }

    public function toggleEmailNotifications()
    {
        $this->emailNotifications = !$this->emailNotifications;
        Setting::set('emailNotifications', $this->emailNotifications, 'system');
        Session::flash('success', 'System email notifications ' . ($this->emailNotifications ? 'enabled' : 'disabled') . ' successfully!');
    }

    public function toggleDataBackup()
    {
        $this->dataBackup = !$this->dataBackup;
        Setting::set('dataBackup', $this->dataBackup, 'system');
        Session::flash('success', 'Automated data backup ' . ($this->dataBackup ? 'enabled' : 'disabled') . ' successfully!');
    }

    public function saveSystemSettings()
    {
        Setting::set('n8nWebhookUrl', $this->n8nWebhookUrl, 'system');
        Setting::set('n8nWebhookSecret', $this->n8nWebhookSecret, 'system');
        Setting::set('autoBackupTime', $this->autoBackupTime, 'system');
        
        Session::flash('success', 'System configurations saved successfully! (Note: Restart serving script if changing system workers/ports)');
    }

    /**
     * Pings the N8N Webhook endpoint to test connectivity.
     */
    public function testN8nConnection()
    {
        $this->n8nConnectionStatus = 'Testing connection...';
        $this->n8nConnectionStatusClass = 'text-blue-600 bg-blue-50';

        try {
            $response = Http::timeout(5)->asJson()->post($this->n8nWebhookUrl, [
                'message' => 'ping',
                'user_id' => 'test_admin',
                'timestamp' => now()->toIso8601String(),
                'is_test' => true
            ]);

            // Webhook-test returns 200 or 404/500 depending on active state
            if ($response->successful()) {
                $this->n8nConnectionStatus = 'Success: Connected to n8n Webhook!';
                $this->n8nConnectionStatusClass = 'text-green-600 bg-green-50';
            } else {
                $this->n8nConnectionStatus = 'Warning: Received ' . $response->status() . ' from n8n (Webhooks might not be running).';
                $this->n8nConnectionStatusClass = 'text-yellow-600 bg-yellow-50';
            }
        } catch (\Exception $e) {
            $this->n8nConnectionStatus = 'Error: Connection failed. Verify n8n container port 5678 and URL.';
            $this->n8nConnectionStatusClass = 'text-red-600 bg-red-50';
        }
    }

    /**
     * Flushes the application cache.
     */
    public function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');
            
            Session::flash('success', 'Application cache, view cache, and config cache cleared successfully!');
        } catch (\Exception $e) {
            Session::flash('error', 'Failed to clear cache: ' . $e->getMessage());
        }
    }

    /**
     * Run full optimize command.
     */
    public function optimizeApp()
    {
        try {
            Artisan::call('optimize');
            Session::flash('success', 'Application optimized successfully! Compiled routes and configuration cached.');
        } catch (\Exception $e) {
            Session::flash('error', 'Optimization failed: ' . $e->getMessage());
        }
    }

    /**
     * Empties the primary laravel.log file.
     */
    public function clearLogs()
    {
        $logPath = storage_path('logs/laravel.log');
        
        try {
            if (file_exists($logPath)) {
                file_put_contents($logPath, '');
                Session::flash('success', 'laravel.log has been successfully cleared!');
            } else {
                Session::flash('success', 'Log file is already clean or does not exist.');
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Failed to clear log file: ' . $e->getMessage());
        }
    }

    public function saveGeneralSettings()
    {
        Setting::set('businessName', $this->businessName, 'general');
        Setting::set('businessEmail', $this->businessEmail, 'general');
        Setting::set('businessPhone', $this->businessPhone, 'general');
        Setting::set('businessAddress', $this->businessAddress, 'general');
        Setting::set('businessCity', $this->businessCity, 'general');
        Setting::set('businessState', $this->businessState, 'general');
        Setting::set('businessZipCode', $this->businessZipCode, 'general');
        Setting::set('businessWebsite', $this->businessWebsite, 'general');
        
        Session::flash('success', 'General settings saved successfully!');
    }

    public function saveEmailSettings()
    {
        Setting::set('smtpHost', $this->smtpHost, 'email');
        Setting::set('smtpPort', $this->smtpPort, 'email');
        Setting::set('emailFromAddress', $this->emailFromAddress, 'email');
        Setting::set('emailFromName', $this->emailFromName, 'email');
        Setting::set('emailNotificationsEnabled', $this->emailNotificationsEnabled, 'email');
        
        Session::flash('success', 'Email settings saved successfully!');
    }

    public function saveNotificationSettings()
    {
        Setting::set('appointmentReminders', $this->appointmentReminders, 'notifications');
        Setting::set('appointmentReminderTime', $this->appointmentReminderTime, 'notifications');
        Setting::set('statusUpdateNotifications', $this->statusUpdateNotifications, 'notifications');
        Setting::set('adminAlerts', $this->adminAlerts, 'notifications');
        
        Session::flash('success', 'Notification settings saved successfully!');
    }

    public function savePaymentSettings()
    {
        Setting::set('paymentGateway', $this->paymentGateway, 'payment');
        Setting::set('currencyCode', $this->currencyCode, 'payment');
        Setting::set('taxPercentage', $this->taxPercentage, 'payment');
        
        Session::flash('success', 'Payment settings saved successfully!');
    }

    public function saveBusinessHours()
    {
        $hours = [
            'monday' => ['open' => $this->mondayOpen, 'close' => $this->mondayClose],
            'tuesday' => ['open' => $this->tuesdayOpen, 'close' => $this->tuesdayClose],
            'wednesday' => ['open' => $this->wednesdayOpen, 'close' => $this->wednesdayClose],
            'thursday' => ['open' => $this->thursdayOpen, 'close' => $this->thursdayClose],
            'friday' => ['open' => $this->fridayOpen, 'close' => $this->fridayClose],
            'saturday' => ['open' => $this->saturdayOpen, 'close' => $this->saturdayClose],
            'sunday' => ['open' => $this->sundayOpen, 'close' => $this->sundayClose],
        ];
        
        Setting::set('businessHours', $hours, 'business');
        
        Session::flash('success', 'Business hours saved successfully!');
    }

    public function saveSecuritySettings()
    {
        Setting::set('passwordMinLength', $this->passwordMinLength, 'security');
        Setting::set('passwordRequireNumbers', $this->passwordRequireNumbers, 'security');
        Setting::set('passwordRequireSpecialChars', $this->passwordRequireSpecialChars, 'security');
        Setting::set('passwordExpireDays', $this->passwordExpireDays, 'security');
        Setting::set('twoFactorAuthRequired', $this->twoFactorAuthRequired, 'security');
        Setting::set('sessionTimeout', $this->sessionTimeout, 'security');
        Setting::set('maxLoginAttempts', $this->maxLoginAttempts, 'security');
        
        Session::flash('success', 'Security settings saved successfully!');
    }

    private function getAppointmentTrend()
    {
        $days = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = Appointment::whereDate('pref_date', $date)->count();
            
            $days[] = $date->format('M d');
            $counts[] = $count;
        }

        return [
            'labels' => $days,
            'data' => $counts,
        ];
    }

    private function getUserGrowth()
    {
        $days = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = User::whereDate('created_at', '<=', $date)->count();
            
            $days[] = $date->format('M d');
            $counts[] = $count;
        }

        return [
            'labels' => $days,
            'data' => $counts,
        ];
    }

    /**
     * Updates Environment variables (APP_ENV and APP_DEBUG) safely.
     */
    public function updateEnvironmentSettings()
    {
        // Safe validation
        $validEnvs = ['local', 'production', 'staging', 'testing'];
        if (!in_array($this->appEnv, $validEnvs)) {
            $this->appEnv = 'local';
        }

        // Save to .env file
        $this->updateEnvFile('APP_ENV', $this->appEnv);
        $this->updateEnvFile('APP_DEBUG', $this->appDebug ? 'true' : 'false');
        
        // Also save to settings table for redundancy/consistency
        Setting::set('appEnv', $this->appEnv, 'system');
        Setting::set('appDebug', $this->appDebug, 'system');

        Session::flash('success', 'Environment settings updated successfully! Mode is now: ' . strtoupper($this->appEnv));
    }

    /**
     * Safely updates key-value pairs in the local .env file.
     */
    private function updateEnvFile($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            $content = file_get_contents($path);
            
            // Check if key exists
            if (preg_match("/^{$key}=.*/m", $content)) {
                // Replace the existing key
                $content = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $content);
            } else {
                // Append key if not exists
                $content .= "\n{$key}={$value}";
            }

            try {
                file_put_contents($path, $content);
                // Clear config cache so Laravel picks it up
                Artisan::call('config:clear');
            } catch (\Exception $e) {
                Log::error('Failed to write to .env or clear config: ' . $e->getMessage());
            }
        }
    }

    public function render()
    {
        // 1. Real Database Queries
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();

        $pendingTasks = Appointment::where('status', 'Pending')->count();

        // 2. Fetch Today's Appointments (Real Data)
        $todaysAppointments = Appointment::whereDate('pref_date', Carbon::today())
            ->take(5)
            ->get();

        // 3. Chart Data - Last 7 Days Appointments
        $appointmentTrend = $this->getAppointmentTrend();

        // 4. Chart Data - User Growth
        $userGrowth = $this->getUserGrowth();

        // 5. Static Stats (Update these later with real server logic if needed)
        $systemUptime = "99.8%";
        $storageUsed = "42.5GB";

        return view('livewire.admin.settings', [
            'totalUsers' => $totalUsers,
            'adminCount' => $adminCount,
            'userCount' => $userCount,
            'pendingTasks' => $pendingTasks,
            'todaysAppointments' => $todaysAppointments,
            'systemUptime' => $systemUptime,
            'storageUsed' => $storageUsed,
            'appointmentTrend' => $appointmentTrend,
            'userGrowth' => $userGrowth,
        ]);
    }
}
