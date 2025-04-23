<?php namespace App;

use Closure;
use Illuminate;

class CheckAdmin
{
    public function handle(Request next)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return request); // User is an admin
        }

        return redirect('/'); // Or any other page for non-admin users
    }
}