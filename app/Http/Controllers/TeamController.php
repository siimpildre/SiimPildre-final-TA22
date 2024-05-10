<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("teams.index", [
            "teams" => Team::paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('teams.store');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'team_name' => ['required', 'string', 'max:40'],
            'short_name' => ['required', 'uppercase', 'string', 'max:3'],
            'coach' => ['required', 'string', 'max:255'],
            'contact_nr' => ['required', 'string', 'max:255'],
        ],
        [
            'team_name.required' => 'Meeskonnanimi on vajalik',
            'short_name.required' => 'Lühend on vajalik',
            'short_name.max' => 'Lühend peab olema 3-täheline',
            'short_name.uppercase' => 'Lühend peab olema SUURTE TÄHTEDEGA',
            'coach.required' => 'Treener on vajalik',
            'contact_nr.required' => 'Kontakt number on vajalik',
        ]);

        $team = Team::create([
            'team_name' => $request->team_name,
            'short_name' => $request->short_name,
            'coach' => $request->coach,
            'contact_nr' => $request->contact_nr,
        ]);

        return redirect(route('teams.index', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team): View
    {
        return view('teams.show', [

            'team' => $team,
            'players' => $team -> players

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team): View
    {

        $players = Player::whereDoesntHave('teams', function (Builder $query) use ($team) {
            $query->whereNot('team_id', $team->id);
        })->get();

        return view('teams.edit', [
            'team' => $team,
            'players' => $players,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team): RedirectResponse
    {

        $validated = $request->validate([

            'team_name' => ['required', 'string', 'max:40'],
            'short_name' => ['required', 'uppercase', 'string', 'max:3'],
            'coach' => ['required', 'string', 'max:255'],
            'contact_nr' => ['required', 'string', 'max:255'],
        ],
        [
            'team_name.required' => 'Meeskonnanimi on vajalik',
            'short_name.required' => 'Lühend on vajalik',
            'short_name.max' => 'Lühend peab olema 3-täheline',
            'short_name.uppercase' => 'Lühend peab olema SUURTE TÄHTEDEGA',
            'coach.required' => 'Treener on vajalik',
            'contact_nr.required' => 'Kontakt number on vajalik',
        ]);

        $team->update($validated);

        return redirect(route('teams.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect('/teams');
    }

    public function detachPlayer(Request $request, Team $team): RedirectResponse
    {
        $team->players()->detach($request->player_id);
        return redirect()->back();
    }

    public function attachPlayer(Request $request, Team $team): RedirectResponse
    {
        $team->players()->attach($request->player_id);
        return redirect()->back();
    }

    public function showMeeskonnadPage()
    {
        $teams = Team::all(); 
        return view('meeskonnad', ['teams' => $teams]);
    }

}