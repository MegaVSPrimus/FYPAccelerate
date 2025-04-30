<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Driver;
use App\Models\Forum;
use App\Models\Image;

use App\Models\FantasyTeam;

class LoginRegisterController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['home', 'logout']),
            new Middleware('auth', only: ['home', 'logout']),
        ];
    }

    public function register(): View
    {
        return view('generic.register');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        $drivers = Driver::all(); // Retrieve all drivers
        $forums = Forum::all();  // Retrieve all forum posts
        $images = Image::all();  // Retrieve all forum posts
        $fantasyTeams = FantasyTeam::all();
        return view('generic.welcome', compact('drivers', 'forums','images','fantasyTeams'));
    }

    public function login(): View
    {
        return view('generic.login');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $remember = $request->has('remember'); // Check if 'remember' is selected
    
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect('/'); // Ensure proper route usage
        }
    
        return back()->withErrors([
            'email' => 'Your provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    
    public function home(): View
    {
        return view('welcome');
    } 
    

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Fetch drivers and forums
        $drivers = Driver::all(); // Retrieve all drivers
        $forums = Forum::all();  // Retrieve all forum posts
        $images = Image::all();  // Retrieve all forum posts
        $fantasyTeams = FantasyTeam::all();

    
        // Redirect to a specific route or URL after logout
        return redirect('/login'); // Replace 'welcome' with the name of your route
    }

    
    
}