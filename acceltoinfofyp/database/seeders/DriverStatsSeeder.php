<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Driver;
use App\Models\DriverStats;

class DriverStatsSeeder extends Seeder
{
    public function run()
    {
        // Example drivers
        $drivers = [
            ['name' => 'Lewis Hamilton', 'team' => 'Mercedes'],
            ['name' => 'Max Verstappen', 'team' => 'Red Bull Racing'],
            // Add more drivers here
        ];

        // Create driver records and their stats
        foreach ($drivers as $driver) {
            $newDriver = Driver::create($driver);
            DriverStats::create([
                'driver_id' => $newDriver->id,
                'number_of_wins' => rand(0, 100),  // Random wins for demo purposes
                'points_scored' => rand(0, 3000),  // Random points for demo purposes
                'number_of_races' => rand(0, 300),  // Random races for demo purposes
                'number_of_podiums' => rand(0, 150)  // Random podiums for demo purposes
            ]);
        }
    }
}
