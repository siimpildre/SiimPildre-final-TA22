<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Models\Player;
use App\Models\Team;
use App\Models\Schedule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();
        $schedules = Schedule::all();
        
        return view("statistics.index", [
            'teams' => $teams,
            'schedules' => $schedules,
            "statistics" => Statistic::paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $scheduleId = $request->query('schedule_id');
        $schedule = Schedule::findOrFail($scheduleId);
    
        $team1Players = $schedule->team1->players;
        $team2Players = $schedule->team2->players;
    
        return view('statistics.create', [
            'schedule' => $schedule,
            'team1Players' => $team1Players,
            'team2Players' => $team2Players,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'statistics' => ['required', 'array'],
            'statistics.*.schedule_id' => ['required', 'exists:schedules,id'],
            'statistics.*.team_id' => ['required', 'exists:teams,id'],
            'statistics.*.player_id' => ['required', 'exists:players,id'],
            'statistics.*.game_jersey_nr' => ['required', 'string'],
            'statistics.*.played' => ['string'],
            'statistics.*.3-p' => ['integer'],
            'statistics.*.free_t' => ['integer'],
            'statistics.*.free_m' => ['integer'],
            'statistics.*.fouls' => ['integer'],
            'statistics.*.techincals' => ['integer'],
            'statistics.*.unsportsman' => ['integer'],
            'statistics.*.points' => ['integer'],
        ],[
            'statistics.*.schedule_id.required' => 'Vali meeskond 1',
        ]); 
    
        foreach ($request->statistics as $playerStatistics) {
            // Create a new Statistic instance
            $statistic = new Statistic();
    
            // Assign the data from the request to the Statistic instance
            $statistic->fill($playerStatistics);
    
            // Save the statistic to the database
            $statistic->save();
        }
    
        return redirect()->route('statistics.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Statistic $statistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Statistic $statistic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Statistic $statistic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statistic $statistic)
    {
        //
    }
}
