<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();
        return view('post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title'           => 'required|string|max:255',
        'slug'            => 'nullable|string|unique:posts,slug|max:255',
        'category_id'     => 'required|exists:categories,id',
        'content'         => 'required|string',
        'featured_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 2MB max
        'is_active'       => 'sometimes|boolean',
    ]);

    $data = $request->all();

    // Handle image upload
    if ($request->hasFile('featured_image')) {
        $image = $request->file('featured_image');
        $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('posts', $filename, 'public');
        $data['featured_image'] = $path;
    }

    $data['user_id'] = auth()->id();
    $data['slug'] = $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->title);

    Post::create($data);

    return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('post.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
{
    $validated = $request->validate([
        'title'         => 'required|string|max:255',
        'slug'          => 'nullable|string|unique:posts,slug,' . $post->id,
        'category_id'   => 'required|exists:categories,id',
        'content'       => 'required',
        'featured_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
        'is_active'     => 'sometimes|boolean',
    ]);

    // Keep current slug if empty
    if (empty($request->slug)) {
        unset($validated['slug']);
    }

    // Handle featured image perfectly
    if ($request->hasFile('featured_image')) {
        // Delete old image
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');

    } elseif ($request->has('remove_image')) {
        // User wants to delete the image
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $validated['featured_image'] = null;

    } else {
        // No new file + no remove → keep current image
        unset($validated['featured_image']);
    }

    $post->update($validated);

    return redirect()
        ->route('admin.posts.index')
        ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.'); 
    }
}
