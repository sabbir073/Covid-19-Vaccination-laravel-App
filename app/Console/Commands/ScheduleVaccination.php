<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration;
use App\Models\VaccineCenter;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ScheduleVaccination extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:schedule-vaccination';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically schedule vaccination for users based on center daily limits';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch all vaccine centers
        $centers = VaccineCenter::all();

        foreach ($centers as $center) {
            // Fetch all users registered for this center but not yet scheduled
            $registrations = Registration::where('vaccine_center_id', $center->id)
                ->whereNull('scheduled_date') // Not yet scheduled
                ->orderBy('created_at') // First-come, first-serve basis
                ->get();

            foreach ($registrations as $registration) {
                // Ensure the scheduling starts at least the next day after registration
                $currentScheduledDate = $registration->created_at->copy()->addDay();

                // Ensure scheduling only happens on weekdays (Sunday to Thursday)
                $currentScheduledDate = $this->findNextAvailableDate($currentScheduledDate);

                // Check if the center has reached its daily limit for this date
                while ($this->isCenterFull($center, $currentScheduledDate)) {
                    // Move to the next available date (skip weekends)
                    $currentScheduledDate = $this->findNextAvailableDate($currentScheduledDate->addDay());
                }

                // Assign the scheduled date and mark the status as 'Scheduled'
                $registration->scheduled_date = $currentScheduledDate;
                $registration->status = 'Scheduled';
                $registration->save();

                // Send an email to the user with their vaccination details
                $this->sendVaccinationEmail($registration);
            }
        }

        $this->info('Vaccination scheduling completed successfully.');
    }

    // Find the next available weekday (Sunday to Thursday)
    private function findNextAvailableDate($date)
    {
        // Skip Friday and Saturday
        while ($date->isFriday() || $date->isSaturday()) {
            $date->addDay();
        }

        return $date;
    }

    // Check if the center has reached its daily limit for the given date
    private function isCenterFull($center, $date)
    {
        $count = Registration::where('vaccine_center_id', $center->id)
            ->whereDate('scheduled_date', $date)
            ->count();

        return $count >= $center->daily_limit;
    }

    // Send email notification to the user
    private function sendVaccinationEmail($registration)
    {
        $user = $registration->user;
        $center = $registration->vaccineCenter;
        $date = $registration->scheduled_date->toFormattedDateString();

        $data = [
            'name' => $user->name,
            'center' => $center->name,
            'scheduled_date' => $date,
        ];

        Mail::send('emails.vaccination-scheduled', $data, function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Your COVID Vaccine Appointment Scheduled');
        });
    }

    //to bypass other scheduler job and make it strict
    public function isDue(Schedule $schedule)
    {
        return true;
    }
}
