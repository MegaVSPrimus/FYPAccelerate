<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverStats extends Model
{
    use HasFactory;

    protected $fillable = ['driver_id', 'number_of_wins', 'points_scored', 'number_of_races', 'number_of_podiums'];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}

