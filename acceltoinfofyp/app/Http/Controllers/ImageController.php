<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Driver;


class ImageController extends Controller
{
    public function create()
    {
        return view('admin.upload');
    }
	public function destroy($id)
{
    // Find the driver by ID
    $driver = Image::findOrFail($id);

    // Delete the driver
    $driver->delete();

    // Redirect to the home page with a success message
    return redirect('/gallery')->with('success', 'Driver deleted successfully!');
}

public function edit($id){
    $image = Image::findOrFail($id); // Use $driver consistently
    return view('admin.image_edit',compact('image'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'path' => 'required|string|max:255',
    ]);

    $image = Driver::findOrFail($id);
    $image->name = $request->input('name');
    $image->path = $request->input('path');
    $image->save();

    return redirect()->route('driver.edit', ['id' => $image->id])->with('success', 'Image updated successfully.');
}


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure only images are uploaded
        ]);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('images', $filename, 'public'); // Store in storage/app/public/images
    
            // Save full path in DB
            $image = new Image();
            $image->name = $request->input('name');
            $image->pathNew = $path; // Store the relative path without 'storage/' part
            $image->save();
    
            return redirect()->back()->with('success', 'Image uploaded successfully');
        }
    }
    


    public function index()
    {
        $images = Image::all();
        return view('admin.gallery', compact('images'));
    }

    public function show($id)
    {
        $image = Image::findOrFail($id);
        return response($image->image)->header('Content-Type', 'image/jpeg');
    }
}
