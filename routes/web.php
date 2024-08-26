<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('qr');
});

Route::get('attend', [\App\Http\Controllers\AttendanceController::class, 'attend'])->name('attend');
Route::post('person/search', [\App\Http\Controllers\PersonController::class, 'search'])->name('person.search');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('attendance', \App\Http\Controllers\AttendanceController::class);
    Route::resource('person', \App\Http\Controllers\PersonController::class);
});
