<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Player;
use App\Models\Team;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();
        
        return view("schedules.index", [
            'teams' => $teams,
            "schedules" => Schedule::paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $teams = Team::all();

        return view('schedules.store', [
            'teams' => $teams
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

        $schedule = Schedule::create([
            'team1_id' => $request->team1_id,
            'team2_id' => $request->team2_id,
            'date' => $request->date,
            'time' => $request->time,
            'venue' => $request->venue,
            'stages' => $request->stages,
        ]);


        return redirect(route('schedules.index', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule): View
    {
        // Fetch the team names using the team IDs from the schedule
        $team1 = Team::findOrFail($schedule->team1_id);
        $team2 = Team::findOrFail($schedule->team2_id);

        // Fetch statistics related to this schedule for each team
        $statisticsTeam1 = Statistic::where('schedule_id', $schedule->id)
            ->where('team_id', $schedule->team1_id)
            ->get();

        $statisticsTeam2 = Statistic::where('schedule_id', $schedule->id)
            ->where('team_id', $schedule->team2_id)
            ->get();
            
        $statisticsTeam1 = $statisticsTeam1->sortByDesc('points');
        $statisticsTeam2 = $statisticsTeam2->sortByDesc('points');
        

        // Pass the schedule and team names to the view
        return view('schedules.show', [
            'schedule' => $schedule,
            'team1_name' => $team1->team_name,
            'team2_name' => $team2->team_name,
            'statisticsTeam1' => $statisticsTeam1,
            'statisticsTeam2' => $statisticsTeam2,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule): View
    {
        $teams = Team::all();

        return view('schedules.edit', [

            'schedule' => $schedule,
            'teams' => $teams,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule): RedirectResponse
    {

        $validated = $request->validate([

            'team1_id' => 'required|exists:teams,id|different:team2_id',
            'team2_id' => 'required|exists:teams,id|different:team1_id',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'nullable|string|max:255',
            'stages' => 'required|string',

        ],[
            'team1_id.required' => 'Vali meeskond 1',
            'team2_id.required' => 'Vali meeskond 2',
            'team1_id.different' => 'Vali erinevad meeskonnad',
            'team2_id.different' => 'Vali erinevad meeskonnad',
            'date.required' => 'Määra mängu kuupäev',
            'time.required' => 'Vali mängu alguskellaeg',
            'stages.required' => 'Määra mängu etapp',
        ]);

        $schedule->update($validated);

        return redirect(route('schedules.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect('/schedules');
    }
}
