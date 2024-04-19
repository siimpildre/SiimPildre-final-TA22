<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ScheduleController;
use App\Models\Team;
use App\Models\Player;
use App\Models\Schedule;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource("teams", TeamController::class);
    Route::resource("players", PlayerController::class);
    Route::resource("schedules", ScheduleController::class);
    

    Route::post('/teams.store', [TeamController::class, 'store']);
    Route::post('/players.store', [PlayerController::class, 'store']);
    Route::post('/schedules.store', [ScheduleController::class, 'store']);

    Route::delete('/detachplayer/{team}', [TeamController::class, 'detachPlayer'])->name('team.detach.player');
    Route::post('/attachplayer/{team}', [TeamController::class, 'attachPlayer'])->name('team.attach.player');

    Route::delete('/detachteam/{schedule}', [ScheduleController::class, 'detachTeam'])->name('schedule.detach.team');
    Route::post('/attachteam/{schedule}', [ScheduleController::class, 'attachTeam'])->name('schedule.attach.team');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('chirps', ChirpController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy'])
        ->middleware(['auth', 'verified']);
});

require __DIR__.'/auth.php';
