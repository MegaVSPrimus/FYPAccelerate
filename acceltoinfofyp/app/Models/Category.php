<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Optional: define fillable fields if needed
    protected $fillable = ['name', 'slug'];

    public function forums()
    {
        return $this->hasMany(\App\Models\Forum::class);
    }
}
