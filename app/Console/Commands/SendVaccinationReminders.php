<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendVaccinationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-vaccination-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to users scheduled for vaccination the next day';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get tomorrow's date in the application's timezone
        $tomorrow = Carbon::now()->addDay()->startOfDay();

        // Fetch all users scheduled for tomorrow
        $registrations = Registration::whereDate('scheduled_date', $tomorrow)->get();

        foreach ($registrations as $registration) {
            // Send reminder email to the user
            $this->sendReminderEmail($registration);
        }

        $this->info('Vaccination reminder emails sent for tomorrow.');
    }

    // Function to send reminder email
    private function sendReminderEmail($registration)
    {
        $user = $registration->user;
        $center = $registration->vaccineCenter;
        $scheduledDate = $registration->scheduled_date->toFormattedDateString();

        $data = [
            'name' => $user->name,
            'center' => $center->name,
            'scheduled_date' => $scheduledDate,
        ];

        // Send email using Laravel's Mail facade
        Mail::send('emails.vaccination-reminder', $data, function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Reminder: Your COVID Vaccine Appointment Tomorrow');
        });
    }
}
