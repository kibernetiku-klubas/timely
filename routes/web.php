<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('meetings/{id}', [MeetingController::class, 'show'])->name('meeting.show');
Route::post('/votes', [VoteController::class, 'store'])->name('vote.store');
Route::get('/export/{meeting_id}/ics', [DateController::class, 'exportToICalendar'])->name('export.ics');
Route::view('/privacy-policy', 'legal.privacy-policy');
Route::view('/terms-of-service', 'legal.terms-of-service');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('meetings', MeetingController::class);
    Route::get('/meeting/{id}/delete', [MeetingController::class, 'confirmDelete']);
    Route::delete('/meeting/{id}/delete', [MeetingController::class, 'destroy'])->name('meetings.delete');
    Route::get('/meeting/{id}/edit', [MeetingController::class, 'displayEdit']);
    Route::patch('/meeting/{id}/edit', [MeetingController::class, 'update'])->name('meetings.update');
    Route::post('/meeting/{id}/finalize-date', [MeetingController::class, 'finalizeDate'])->name('meetings.finalize-date');
    Route::get('/meeting/{id}/finalize-date', [MeetingController::class, 'showFinalizeDate'])->name('meetings.show-finalize-date');

    Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

    Route::view('/add-meeting', 'meetings.add');

    Route::resource('dates', DateController::class);
    Route::post('/dates', [DateController::class, 'store'])->name('dates.store');
    Route::put('/dates/{id}', [DateController::class, 'update'])->name('dates.update');
    Route::delete('/dates/{id}', [DateController::class, 'destroy'])->name('dates.destroy');

    Route::put('/vote/{id}', [VoteController::class, 'update'])->name('vote.update');
    Route::delete('/vote/{id}', [VoteController::class, 'destroy'])->name('vote.destroy');

    Route::get('/dashboard', [MeetingController::class, 'showDashboard'])->name('dashboard');
    Route::view('/pr', 'pr-egg');
});

require __DIR__ . '/auth.php';
