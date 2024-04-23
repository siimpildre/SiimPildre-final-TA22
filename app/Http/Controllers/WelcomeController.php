<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Team;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        $teams = Team::all();
        
        return view('welcome', [
            'teams' => $teams,
            'schedules' => $schedules,
            "welcome" => Welcome::paginate(20),
        ]);
    }
}