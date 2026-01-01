<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        return Post::create($request->all());
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        return $post;
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }
}