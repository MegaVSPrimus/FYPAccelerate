<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index()
    {
        // Return all drivers in JSON format
        return response()->json(Driver::all());
    }
}
