<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PlayerController extends Controller
{
    public function index()
    {
        return view("players.index", [
            "players" => Player::paginate(20),
        ]);
    }

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('players.store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:25'],
            'last_name' => ['required', 'string', 'max:25'],
            'jersey_nr' => ['required', 'string', 'max:3'],
            'pos_nr' => ['required', 'string', 'between:1,5'],
            'birth_date' => ['required', 'date'],
            'height' => ['required', 'string', 'max:3'],
        ],
        [
            'first_name.required' => 'Eesnimi on vajalik',
            'last_name.required' => 'Perekonnanimi on vajalik',
            'pos_nr.required' => 'Sisesta positsiooni number 1-5',
            'birth_date.required' => 'Sisesta sünniaeg',
            'height.required' => 'Sisesta mängija pikkus',
            'height.max' => 'Kas tõesti on mängija nii pikk?',
        ]);

        $player = Player::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'jersey_nr' => $request->jersey_nr,
            'pos_nr' => $request->pos_nr,
            'birth_date' => $request->birth_date,
            'height' => $request->height,
        ]);

        return redirect(route('players.index', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player): View
    {
        return view('players.show', [

            'player' => $player,
            'teams' => $player -> teams

        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player): View
    {
        return view('players.edit', [

            'player' => $player,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player): RedirectResponse
    {

        $validated = $request->validate([

            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'jersey_nr' => 'string|max:255',
            'pos_nr' => 'required|string|between:1,5',
            'birth_date' => 'required|string|max:255',
            'height' => 'required|string|max:255',
            
        ],
        [
            'first_name.required' => 'Eesnimi on vajalik',
            'last_name.required' => 'Perekonnanimi on vajalik',
            'pos_nr.required' => 'Sisesta positsiooni number 1-5',
            'birth_date.required' => 'Sisesta sünniaeg',
            'height.required' => 'Sisesta mängija pikkus',
        ]);

        $player->update($validated);

        return redirect(route('players.index'));
    }


    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Player $player)
    {
        $book->delete();
        return redirect('/players');
    }

    public function showMangijadPage()
    {
        $players = Player::all(); 
        return view('mangijad', ['players' => $players]);
    }

    public function filterPlayers(Request $request)
    {
        $teams = Team::all(); // Fetch all teams for dropdown
        $playersQuery = Player::query();
    
        if ($request->has('team') && $request->team !== '') {
            // If a team is selected, filter players by team
            $playersQuery->whereHas('teams', function ($query) use ($request) {
                $query->where('team_id', $request->team);
            });
        }
    
        $players = $playersQuery->get();
    
        // Pass $teams variable to the view
        return view('your.view', compact('players', 'teams'));
    }
    
}
