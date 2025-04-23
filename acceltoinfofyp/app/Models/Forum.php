<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'forum';
	
	public $timestamps = true;
	
	protected $fillable=['title','description'];
	public function comments()
{
    return $this->hasMany(Comment::class, 'forum_post_id');
}
public function category()
{
    return $this->belongsTo(Category::class);
}

public function images() {
    return $this->hasMany(Image::class, 'forumid');
}



}
