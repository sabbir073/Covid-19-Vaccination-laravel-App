<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vaccine_center_id',
        'scheduled_date',
        'status',
    ];

    // Cast the scheduled_date as a datetime
    protected $casts = [
        'scheduled_date' => 'datetime',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Vaccine Center
    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }

    // Schedule the vaccination date for the user based on vaccine center capacity
    public static function scheduleVaccination($vaccineCenterId)
    {
        // Get the vaccine center
        $center = VaccineCenter::find($vaccineCenterId);

        // Get today's date and the next available weekday (Sunday to Thursday)
        $today = now();
        $scheduledDate = $today->copy()->startOfDay();

        // Check the capacity and schedule the next available date
        $currentDayRegistrations = Registration::where('vaccine_center_id', $center->id)
            ->whereDate('scheduled_date', $scheduledDate)
            ->count();

        while ($currentDayRegistrations >= $center->daily_limit) {
            // Move to the next weekday (skip weekends)
            $scheduledDate->addDay();
            if ($scheduledDate->isFriday() || $scheduledDate->isSaturday()) {
                $scheduledDate->addDay();
            }

            // Check registrations for the new scheduled date
            $currentDayRegistrations = Registration::where('vaccine_center_id', $center->id)
                ->whereDate('scheduled_date', $scheduledDate)
                ->count();
        }

        // Return the final scheduled date
        return $scheduledDate;
    }
}
