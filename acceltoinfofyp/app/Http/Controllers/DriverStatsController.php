<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DriverStats;
use App\Models\Driver;
use App\Models\Image;


class DriverStatsController extends Controller
{
    public function index()
    {
        // Fetch all driver stats
        $driverStats = DriverStats::all();
        $drivers = Driver::all();
        $images = Image::all();
        return view('drivers.driverstats', compact('driverStats','drivers','images'));

    }

    public function show($id)
    {
        // Fetch specific driver stats by ID
        $driverStats = DriverStats::with('driver')->find($id);
        if ($driverStats) {
            return response()->json($driverStats);
        } else {
            return response()->json(['message' => 'Driver stats not found'], 404);
        }
    }

    public function store(Request $request)
    {
        // Validate and create new driver stats
        $request->validate([
            'driver_id' => 'required|integer|exists:drivers,id',
            'number_of_wins' => 'required|integer',
            'points_scored' => 'required|integer',
            'number_of_races' => 'required|integer',
            'number_of_podiums' => 'required|integer',
        ]);

        $driverStats = DriverStats::create($request->all());
        return response()->json($driverStats, 201);
    }

    public function update(Request $request, $id)
    {
        // Validate and update existing driver stats
        $request->validate([
            'driver_id' => 'sometimes|required|integer|exists:drivers,id',
            'number_of_wins' => 'sometimes|required|integer',
            'points_scored' => 'sometimes|required|integer',
            'number_of_races' => 'sometimes|required|integer',
            'number_of_podiums' => 'sometimes|required|integer',
        ]);

        $driverStats = DriverStats::find($id);
        if ($driverStats) {
            $driverStats->update($request->all());
            return response()->json($driverStats);
        } else {
            return response()->json(['message' => 'Driver stats not found'], 404);
        }
    }

    public function destroy($id)
    {
        // Delete driver stats by ID
        $driverStats = DriverStats::find($id);
        if ($driverStats) {
            $driverStats->delete();
            return response()->json(['message' => 'Driver stats deleted']);
        } else {
            return response()->json(['message' => 'Driver stats not found'], 404);
        }
    }
}