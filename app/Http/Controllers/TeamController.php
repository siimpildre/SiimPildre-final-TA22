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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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