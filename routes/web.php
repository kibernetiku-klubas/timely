<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('meetings/{id}', [MeetingController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [MeetingController::class, 'showDashboard'])->name('dashboard');
    Route::resource('meetings', MeetingController::class);
    Route::view('/add-meeting', 'meetings.add');
});

require __DIR__ . '/auth.php';
