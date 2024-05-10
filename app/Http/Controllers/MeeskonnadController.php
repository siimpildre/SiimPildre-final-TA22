<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;

class MeeskonnadController extends Controller
{
    public function index()
    {
        $players = Player::all();
        $teams = Team::all();
        
        return view('tulemused', [
            'teams' => $teams,
            'players' => $player,
        ]);
    }
}