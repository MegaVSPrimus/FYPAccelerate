<?php 

namespace App\Http\Controllers;

use App\Models\Driver; // Make sure the Driver model is imported
use App\Models\Team; // Make sure the Driver model is imported
use App\Models\Image; // Make sure the Driver model is imported

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TeamController extends Controller
{
    public function index(){
        $teams = Team::all(); // Retrieve all drivers from the database
		$images = Image::all();

        return view('teams.teams', compact('teams','images')); // Assuming you want to pass the data to a view
    }
    public function insert(){
        return view('teams.team_create');
    }
	public function destroy($id)
{
    // Find the driver by ID
    $team = Team::findOrFail($id);

    // Delete the driver
    $team->delete();

    // Redirect to the home page with a success message
    return redirect('/teams.teams')->with('success', 'Team deleted successfully!');
}


	
    public function create(Request $request){
        $rules = [


		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('insert')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$team = new Team;
                $team->name = $data['name'];
				$team->team_principal = $data['team_principal'];
				$team->engine_supplier = $data['engine_supplier'];
				$team->constructors_championships = $data['constructors_championships'];
				$team->driver1 = $data['driver1'];
				$team->driver2 = $data['driver2'];

				$team->save();
				return redirect('teams')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('teams')->with('failed',"operation failed");
			}
		}
    }
	// Display the form for editing the driver
	public function edit($id){
		$team = Team::findOrFail($id); // Use $driver consistently
		return view('teams.team_edit',compact('team'));
	}
	

public function update(Request $request, $id)
{
	$request->validate([
		'name' => 'required|string|max:255',
		'team_principal' => 'required|string|max:255',
		'engine_supplier' => 'required|string|max:255',
		'constructors_championships' => 'required|integer',
	]);
	
    $team = Team::findOrFail($id); // Find the driver by ID or show 404 if not found
	$team->name = $request->input('name');
	$team->team_principal = $request->input('team_principal');
	$team->engine_supplier = $request->input('engine_supplier');
	$team->constructors_championships = $request->input('constructors_championships');	
	$team->save();
    return redirect('/')->with('success', 'Team deleted successfully!');
}

public function show($id)
{
    $team = Team::findOrFail($id);
	// Fetch stats related to the specific driver
	
	return view('teams.teams_single', compact('team'));}


    }