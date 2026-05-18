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

#[Layout('components.layouts.admin')]
#[Title('Settings | Repairmax')]
class Settings extends Component
{
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

    public function mount()
    {
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
