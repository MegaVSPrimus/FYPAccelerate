<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{

    protected $table = 'drivers';
	
	public $timestamps = true;
	
	protected $fillable=['name','team'];

    public function fantasyTeams()
    {
        return $this->belongsToMany(FantasyTeam::class, 'fantasy_team_drivers');
    }

    public function points()
    {
        return $this->morphOne(Point::class, 'pointable');
    }
    


}