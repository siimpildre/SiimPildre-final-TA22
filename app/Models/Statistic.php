<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statistic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'schedule_id', 'team_id', 'player_id', 'game_jersey_nr', 'played', '3-p', 'free_t', 'free_m', 'fouls', 'techincals', 'unsportsman', 'points',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
