<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\VaccineCenter;
use App\Models\User;
use App\Models\Registration;
use App\Http\Controllers\VaccinationStatusController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/vaccine-centers', function () {
    return VaccineCenter::all();
});

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'nid' => 'required|string|unique:users,nid',
        'email' => 'required|string|email|max:255|unique:users,email',
        'vaccine_center_id' => 'required|exists:vaccine_centers,id',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'nid' => $validated['nid'],
        'email' => $validated['email'],
    ]);

    // Create a new registration entry
    Registration::create([
        'user_id' => $user->id,
        'vaccine_center_id' => $validated['vaccine_center_id'],
    ]);

    return response()->json(['message' => 'Registration successful']);
});


// Route for search status
Route::post('/search', [VaccinationStatusController::class, 'searchStatus']);