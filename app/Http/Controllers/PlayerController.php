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
            "players" => Player::paginate(2),
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
    public function show(Player $player)
    {
        return view('players.show', [

            'player' => $player,

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
            'jersey_nr' => 'required|string|max:255',
            'pos_nr' => 'required|string|between:0,6',
            'birth_date' => 'required|string|max:255',
            'height' => 'required|string|max:255',
            
        ],
        [
            // 'release_date.required' => 'The release year field is required',
            // 'release_date.between' => 'The release year field must be between 1901 and 2155'

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
}
