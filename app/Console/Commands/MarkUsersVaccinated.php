<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration;
use Carbon\Carbon;

class MarkUsersVaccinated extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-users-vaccinated';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark users as vaccinated if their scheduled date was yesterday';

    /**
     * Execute the console command.
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get yesterday's date in the application's timezone
        $yesterday = Carbon::now()->subDay()->startOfDay();

        // Fetch all users who were scheduled for yesterday but are not marked as vaccinated
        $registrations = Registration::whereDate('scheduled_date', $yesterday)
            ->where('status', 'Scheduled') // Only check users with status 'Scheduled'
            ->get();

        foreach ($registrations as $registration) {
            // Update status to 'Vaccinated'
            $registration->status = 'Vaccinated';
            $registration->save();
        }

        $this->info('All users scheduled for yesterday have been marked as vaccinated.');
    }
}
