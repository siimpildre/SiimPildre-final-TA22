<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Team;
use App\Models\Chirp;

class WelcomeController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        $teams = Team::all();
        $chirps = Chirp::latest()->get();
        
        return view('welcome', [
            'teams' => $teams,
            'schedules' => $schedules,
            'chirps' => $chirps,
        ]);
    }
}
