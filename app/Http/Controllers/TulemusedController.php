<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Team;

class TulemusedController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        $teams = Team::all();
        
        return view('tulemused', [
            'teams' => $teams,
            'schedules' => $schedules,
        ]);
    }
}