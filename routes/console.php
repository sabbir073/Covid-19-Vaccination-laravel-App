<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();


// Schedule the command to run every hour
Schedule::command('app:schedule-vaccination')->hourly();

// Run at 9 PM daily to send next day vaccination
Schedule::command('app:send-vaccination-reminders')->dailyAt('21:00'); // Run at 9 PM daily

//mark user vaccinated after the day passes
Schedule::command('app:mark-users-vaccinated')->dailyAt('00:01'); // Run at 12:01 AM daily