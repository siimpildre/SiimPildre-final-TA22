<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;
use App\Models\Schedule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;

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
    public function create()
    {
        $teams = Team::all();
        $schedules = Schedule::all();

        return view('statistics.create', [
            'teams' => $teams,
            'schedules' => $schedules,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'team1_id' => ['required', 'exists:teams,id'],
            'team2_id' => ['required', 'exists:teams,id', 'different:team1_id'],
            'date' => ['required', 'date'],
            'time' => ['required'],
            'venue' => ['nullable', 'string', 'max:255'],
            'stages' => ['required', 'string'],
        ],[
            'team1_id.required' => 'Vali meeskond 1',
            'team2_id.required' => 'Vali meeskond 2',
            'team2_id.different' => 'Vali erinevad meeskonnad',
            'date.required' => 'Määra mängu kuupäev',
            'time.required' => 'Vali mängu alguskellaeg',
            'stages.required' => 'Määra mängu etapp',
        ]);

        $statistic = Statistic::create([
            'team1_id' => $request->team1_id,
            'team2_id' => $request->team2_id,
            'date' => $request->date,
            'time' => $request->time,
            'venue' => $request->venue,
            'stages' => $request->stages,
        ]);


        return redirect(route('statistics.index', absolute: false));
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
