<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\WelcomeController;
use App\Models\Team;
use App\Models\Player;
use App\Models\Schedule;
use App\Models\Statistic;

Route::get('/', function () {
    $schedules = Schedule::all();
    return view('welcome', ['schedules' => $schedules]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tulemused', function () {
    return view('tulemused');
});

Route::middleware('auth')->group(function () {
    Route::resource("teams", TeamController::class);
    Route::resource("players", PlayerController::class);
    Route::resource("schedules", ScheduleController::class);
    Route::resource("statistics", StatisticController::class);

    Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome.index');


    Route::get('/statistics/create', [StatisticController::class, 'create'])->name('statistics.create');

    Route::post('/teams.store', [TeamController::class, 'store']);
    Route::post('/players.store', [PlayerController::class, 'store']);
    Route::post('/schedules.store', [ScheduleController::class, 'store']);
    Route::post('/statistics.store', [StatisticController::class, 'store']);

    Route::delete('/detachplayer/{team}', [TeamController::class, 'detachPlayer'])->name('team.detach.player');
    Route::post('/attachplayer/{team}', [TeamController::class, 'attachPlayer'])->name('team.attach.player');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('chirps', ChirpController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy'])
        ->middleware(['auth', 'verified']);
});

require __DIR__.'/auth.php';
