<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registration;

class VaccinationStatusController extends Controller
{
    public function searchStatus(Request $request)
    {
        $nid = $request->input('nid');

        // Find user by NID
        $user = User::where('nid', $nid)->first();

        // If the user is not found, return 'Not registered'
        if (!$user) {
            return response()->json([
                'status' => 'Not registered'
            ], 404);
        }

        // Find registration for the user
        $registration = Registration::where('user_id', $user->id)->first();

        // If registration not found, return 'Not registered'
        if (!$registration) {
            return response()->json([
                'status' => 'Not registered'
            ]);
        }

        // Return the status directly from the registration record
        $status = $registration->status;

        // If the status is 'Scheduled' or 'Vaccinated', return the scheduled_date as well
        if ($status === 'Scheduled' || $status === 'Vaccinated') {
            return response()->json([
                'status' => $status,
                'scheduled_date' => $registration->scheduled_date->toFormattedDateString(),
            ]);
        }

        // Otherwise, just return the status
        return response()->json([
            'status' => $status
        ]);
    }
}
