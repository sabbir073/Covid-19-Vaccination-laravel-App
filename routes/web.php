<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// This will serve the registration form view
Route::get('/registration', function () {
    return view('registration'); // This will point to the registration form view file.
});

// This will serve the registration form view
Route::get('/search', function () {
    return view('search'); // This will point to the registration form view file.
});