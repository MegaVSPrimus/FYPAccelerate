<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FantasyTeam;

class Team extends Model
{

    protected $table = 'teams';
    public $timestamps = true; // Ensures Laravel manages created_at and updated_at

    protected $fillable = ['name', 'team_principal', 'engine_supplier','constructors_championships','driver1','driver2'];


    public function fantasyTeams()
{
    return $this->belongsToMany(FantasyTeam::class, 'fantasy_team_teams', 'team_id', 'fantasy_team_id');
}

public function points()
{
    return $this->morphOne(Point::class, 'pointable');
}


}
