<?php

namespace App\Models;
use App\Models\Point;


use Illuminate\Database\Eloquent\Model;

class FantasyTeam extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function points()
    {
        return $this->hasMany(Point::class);
    }


    public function drivers()
{
    return $this->belongsToMany(Driver::class, 'fantasy_team_drivers', 'fantasy_team_id', 'driver_id');
}

public function teams()
{
    return $this->belongsToMany(Team::class, 'fantasy_team_teams', 'fantasy_team_id', 'team_id');
}

    
    
}
