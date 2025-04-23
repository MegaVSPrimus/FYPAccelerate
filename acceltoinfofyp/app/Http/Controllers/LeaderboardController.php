<?php

namespace App\Http\Controllers;

use App\Models\FantasyTeam;

class LeaderboardController extends Controller
{
    public function index()
    {
       
        // Fetch all fantasy teams along with their drivers and teams, and points
        $fantasyTeams = FantasyTeam::with(['drivers.points', 'teams.points'])->get();

        // Calculate the total points for each fantasy team
        $fantasyTeams->map(function ($team) {
            $team->total_points = $team->drivers->sum(function ($driver) {
                return $driver->points->points ?? 0; // Sum points of all drivers
            }) + $team->teams->sum(function ($teamEntry) {
                return $teamEntry->points->points ?? 0; // Sum points of all teams
            });
            return $team;
        });

        // Pass fantasy teams to the view
        return view('fantasy.leaderboard', compact('fantasyTeams'));
  
    }
    
}
