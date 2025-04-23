<?php 

namespace App\Http\Controllers;

use App\Models\Driver; // Make sure the Driver model is imported
use App\Models\Image; // Make sure the Driver model is imported
use App\Models\DriverStats; // Make sure the Driver model is imported


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DriverController extends Controller
{
    public function index(){
        $drivers = Driver::all(); // Retrieve all drivers from the database
		$images = Image::all();
        $driverStats = DriverStats::all();
        // Iterate over each driver
foreach ($drivers as $driver) {
    // Check if the driver exists in the driverStats table
    $driverStatsExists = DriverStats::where('driver_id', $driver->id)->exists();

    // If the driver doesn't exist in driverStats, create a default entry
    if (!$driverStatsExists) {
        DriverStats::create([
            'driver_id' => $driver->id, // Link to the driver
            'number_of_wins' => 0, // Example default value (replace 'stat1' with actual fields)
            'points_scored' => 0, // Example default value (replace 'stat1' with actual fields)
            'number_of_races' => 0, // Example default value
            'number_of_podiums' => 0, // Add more fields as necessary
        ]);
    }
}

        return view('drivers.drivers', compact('drivers','images','driverStats')); // Assuming you want to pass the data to a view
    }
    public function insert(){
        return view('drivers.driver_create');
    }
	public function destroy($id)
{
    // Find the driver by ID
    $driver = Driver::findOrFail($id);

    // Delete the driver
    $driver->delete();

    // Redirect to the home page with a success message
    return redirect('/drivers')->with('success', 'Driver deleted successfully!');
}


    public function create(Request $request){
        $rules = [
			'name' => 'required|string|min:3|max:255',
			'team' => 'required|string|min:3|max:255',

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
				$driver = new Driver;
                $driver->name = $data['name'];
				$driver->team = $data['team'];
				$driver->save();
				return redirect('insert')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('insert')->with('failed',"operation failed");
			}
		}
    }
	// Display the form for editing the driver
	public function edit($id){
		$driver = Driver::findOrFail($id); // Use $driver consistently
        $driverStats = DriverStats::where('driver_id', $id)->firstOrFail();
		return view('drivers.driver_edit',compact('driver','driverStats'));
	}
	

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'team' => 'required|string|max:255',
		]);
	
		$driver = Driver::findOrFail($id);
        $driverStats = DriverStats::where('driver_id', $id)->firstOrFail();
		$driver->name = $request->input('name');
		$driver->team = $request->input('team');
        $driverStats->number_of_wins = $request->input('number_of_wins');
        $driverStats->number_of_podiums = $request->input('number_of_podiums');
        $driverStats->points_scored = $request->input('points_scored');
        $driverStats->number_of_races = $request->input('number_of_races');

		$driver->save();
        $driverStats->save();
	
		return redirect()->route('driver.edit', ['id' => $driver->id])->with('success', 'Driver updated successfully.');
	}

    public function show($id)
    {
        $driver = Driver::findOrFail($id);
        // Fetch stats related to the specific driver
        $driverStats = DriverStats::where('driver_id', $id)->first();
        
        return view('drivers.driver_single', compact('driver', 'driverStats'));
    }
    

    }