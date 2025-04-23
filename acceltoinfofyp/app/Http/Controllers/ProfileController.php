<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $request->user(); // Assign to a variable
        return view('profile', compact('request')); // Pass variable name as a string to compact()
    }

    public function setAdmin(Request $request, User $user)
{
    // Check if the authenticated user is an admin
    if (!auth()->user()->is_admin) {
        return redirect()->back()->with('error', 'You do not have permission to perform this action.');
    }

    // Update the user's admin status based on the form submission
    $user->is_admin = $request->has('is_admin') ? true : false;
    $user->save();

    return redirect()->back()->with('success', 'User admin status updated.');
}
public function updateAdmin(Request $request,$id)
{
    {
        // Find the user by ID
        $user = User::findOrFail($id);
    
        // Update the admin status
        $user->is_admin = $request->has('is_admin') ? 1 : 0;
        $user->save();
    
        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}

public function updateProfile(Request $request)
{
    // Validate input fields
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . auth()->user()->id,
        'password' => 'required|string|max:255',

    ]);

    $user = auth()->user();

    // Update user data
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;


    $user->save();

    return redirect('profile');
}
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function allUsers(Request $request)
    {
        $allUsers = User::all(); // Retrieve all drivers from the database
        return view('admin.allUsers', compact('allUsers')); // Assuming you want to pass the data to a view

    }
}
