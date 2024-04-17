<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
            'team_name' => ['required', 'string', 'max:25'],
            'short_name' => ['required', 'uppercase', 'string', 'max:3'],
            'coach' => ['required', 'string', 'max:255'],
            'contact_nr' => ['required', 'string', 'max:255'],
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
    public function show(Team $team)
    {
        return view('teams.show', [

            'team' => $team,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team): View
    {
        return view('teams.edit', [

            'team' => $team,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team): RedirectResponse
    {

        $validated = $request->validate([

            'team_name' => 'required|string|max:25',
            'short_name' => 'required|string|max:3',

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
}