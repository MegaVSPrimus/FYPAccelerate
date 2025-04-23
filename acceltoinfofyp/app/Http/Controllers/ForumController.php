<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Image;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = Forum::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $forum = $query->paginate(10);
        $categories = Category::all();

        return view('forum.forums', compact('forum', 'categories'));
    }

    public function insert()
    {
        $categories = Category::all();
        $images = Image::all();
        return view('forum.forum_create', compact('categories','images'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'category_id' => 'nullable|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $forum = new Forum;
        $forum->title = $request->input('title');
        $forum->description = $request->input('description');
        $forum->category_id = $request->input('category_id');

        if ($request->hasFile('image')) {
            $forum->image = $request->file('image')->store('forum_images', 'public');
        }

        $forum->save();

        return redirect('/forum')->with('status', "Forum post created successfully");
    }

    public function show($id)
    {
        $forum = Forum::findOrFail($id);
        $images = Image::all();
        return view('forum.forum_single', compact('forum','images'));
    }

    public function destroy($id)
    {
        $forum = Forum::findOrFail($id);

        if ($forum->image) {
            Storage::delete('public/' . $forum->image);
        }

        $forum->delete();

        return redirect('/forums')->with('success', 'Forum post deleted successfully!');
    }

    public function edit($id)
    {
        $forum = Forum::findOrFail($id);
        $categories = Category::all();
        return view('forum.forum_edit', compact('forum', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'category_id' => 'nullable|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $forum = Forum::findOrFail($id);
        $forum->title = $request->input('title');
        $forum->description = $request->input('description');
        $forum->category_id = $request->input('category_id');

        if ($request->hasFile('image')) {
            if ($forum->image) {
                Storage::delete('public/' . $forum->image);
            }
            $forum->image = $request->file('image')->store('forum_images', 'public');
        }

        $forum->save();

        return redirect()->route('forum.edit', ['id' => $forum->id])->with('success', 'Post updated successfully.');
    }
}
