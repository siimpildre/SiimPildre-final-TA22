<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded = [];

    public $timestamps = false;
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_players');
    }

    public function statistics()
    {
        return $this->hasMany(Statistic::class);
    }

}