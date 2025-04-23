<?php 
namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Forum;
use App\Models\Image;

use App\Models\FantasyTeam;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch drivers and forums
        $drivers = Driver::all(); // Retrieve all drivers
        $forums = Forum::all();  // Retrieve all forum posts
        $images = Image::all();  // Retrieve all forum posts
        $fantasyTeams = FantasyTeam::all();

        // Pass data to the view
        return view('generic.welcome', compact('drivers', 'forums','images','fantasyTeams'));
    }
}
