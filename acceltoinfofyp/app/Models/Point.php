<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = ['points'];

    public function pointable()
    {
        return $this->morphTo();
    }
}
