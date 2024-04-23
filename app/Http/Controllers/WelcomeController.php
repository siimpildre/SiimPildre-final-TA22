<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $gameSchedules = GameSchedule::all(); // Retrieve all game schedules
        
        return view('welcome', ['gameSchedules' => $gameSchedules]);
    }
}
