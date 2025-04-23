<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FantasyTeam;
use App\Models\Driver;
use App\Models\DriverStats;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class FantasyTeamController extends Controller
{
    // Display all fantasy teams
    public function index()
    {
        $drivers = Driver::all();
        $teams = Team::all();

        // Find or create a fantasy team for the logged-in user
        $fantasyTeam = FantasyTeam::where('user_id', auth()->id())->with('drivers', 'teams', 'user')->first();

        // Load drivers and teams relationships
        return view('fantasy.fantasyshow', compact('drivers', 'teams', 'fantasyTeam'));
    }
    public function showTeam()
{
    // Fetch all drivers and teams for reference
    $drivers = Driver::all();
    $teams = Team::all();

    // Retrieve the current user's fantasy team with relationships loaded
    $fantasyTeam = FantasyTeam::where('user_id', auth()->id())
        ->with('drivers', 'teams', 'user')
        ->first();

    if (!$fantasyTeam) {
        // If the fantasy team doesn't exist, create one
        $fantasyTeam = FantasyTeam::create([
            'user_id' => auth()->id(),
            'name' => 'My Fantasy Team',
        ]);
    }

    // Calculate the total points for the fantasy team
    $totalPoints = 0;
    foreach ($fantasyTeam->drivers as $driver) {
        $stats = DriverStats::where('driver_id', $driver->id)->latest()->first();
        $totalPoints += $stats ? $stats->points : 0;
    }
    foreach ($fantasyTeam->teams as $team) {
        $teamPoints = $team->points()->latest()->first();
        $totalPoints += $teamPoints ? $teamPoints->points : 0;
    }

    return view('fantasy.fantasyshow', compact('drivers', 'teams', 'fantasyTeam', 'totalPoints'));
}


    // Add a driver to the user's fantasy team
    public function addDriverToTeam(Request $request)
    {
        // Find or create the fantasy team for the user
        $fantasyTeam = FantasyTeam::where('user_id', auth()->id())->with('drivers', 'teams', 'user')->first();

        // Validate if the fantasy team exists
        if (!$fantasyTeam) {
            return redirect()->back()->withErrors(['Fantasy team not found.']);
        }

        // Check if 2 drivers are already added
        if ($fantasyTeam->drivers->count() >= 2) {
            return redirect()->back()->with('status', 'You can only add up to 2 drivers to your fantasy team.');
        }

        // Validate the driver exists
        $driver = Driver::find($request->driver_id);
        if (!$driver) {
            return redirect()->back()->withErrors(['Driver not found.']);
        }

        // Attach the driver to the fantasy team without duplicating
        $fantasyTeam->drivers()->syncWithoutDetaching([$driver->id]);

        return redirect()->back()->with('status', 'Driver added successfully!');
    }

    // Remove a driver from the user's fantasy team
    public function removeDriverFromTeam(Request $request)
    {
        $fantasyTeam = FantasyTeam::where('user_id', auth()->id())->first();

        if (!$fantasyTeam) {
            return redirect()->back()->withErrors(['Fantasy team not found.']);
        }

        // Detach the driver from the fantasy team
        $fantasyTeam->drivers()->detach($request->driver_id);

        return redirect()->back()->with('status', 'Driver removed successfully.');
    }

    // Add a team to the user's fantasy league
    public function addTeamToLeague(Request $request)
    {
        $fantasyTeam = FantasyTeam::where('user_id', auth()->id())->first();

        if (!$fantasyTeam) {
            return redirect()->back()->withErrors(['Fantasy team not found.']);
        }

        // Check if a team is already added
        if ($fantasyTeam->teams->count() >= 1) {
            return redirect()->back()->with('status', 'You can only add 1 team to your fantasy league.');
        }

        // Validate the team exists
        $team = Team::find($request->team_id);
        if (!$team) {
            return redirect()->back()->withErrors(['Team not found.']);
        }

        // Attach the team to the fantasy team without duplicating
        $fantasyTeam->teams()->syncWithoutDetaching([$team->id]);

        return redirect()->back()->with('status', 'Team added successfully!');
    }

    // Remove a team from the user's fantasy league
    public function removeTeamFromLeague(Request $request)
    {
        $fantasyTeam = FantasyTeam::where('user_id', auth()->id())->first();

        if (!$fantasyTeam) {
            return redirect()->back()->withErrors(['Fantasy team not found.']);
        }

        // Detach the team from the fantasy team
        $fantasyTeam->teams()->detach($request->team_id);

        return redirect()->back()->with('status', 'Team removed successfully.');
    }
}
