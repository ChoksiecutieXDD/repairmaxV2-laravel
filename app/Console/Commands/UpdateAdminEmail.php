<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; // Pulls in your User model
use Illuminate\Support\Facades\DB;

class UpdateAdminEmail extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'admin:update-email';

    /**
     * The console command description.
     */
    protected $description = 'Updates the admin email to repairmaxsample@gmail.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Using Laravel's query builder so it automatically respects your MySQL .env settings
        $updated = DB::table('users')
            ->where('role', 'admin')
            ->update(['email' => 'repairmaxsample@gmail.com']);

        if ($updated) {
            $this->info("Admin email updated successfully to repairmaxsample@gmail.com");
        } else {
            $this->error("Failed to update admin email (or no admin user was found).");
        }
    }
}
