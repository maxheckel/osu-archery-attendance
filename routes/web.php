<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('qr');
});

Route::get('attend', [\App\Http\Controllers\AttendanceController::class, 'attend'])->name('attend');

Route::post('person/search', [\App\Http\Controllers\PersonController::class, 'search'])->name('person.search');
Route::get('/success', function () {
    return Inertia::render('Success');
})->name('success');
Route::resource('person', \App\Http\Controllers\PersonController::class);
Route::resource('attendance', \App\Http\Controllers\AttendanceController::class);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'show'])->name('dashboard');

});
