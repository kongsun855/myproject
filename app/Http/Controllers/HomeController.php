<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
    
        $data = ['page' => 'Home'];

        $categoryId = $request->input('category'); // or $request->category if using route model binding or form data

        $post = Post::when($categoryId, function ($query) use ($categoryId) {
        return $query->where('category_id', $categoryId);
        })
        //search
        ->when($request->search, function ($query,$search)  {
        $query->where('title', 'LIKE','%'.$search.'%');
        })
        ->get();
        $categories = Category::all();

        return view('index', compact('post', 'categories'));
    }

    public function article(Request $request, $id){
        $post = Post::findOrFail($id);

        return view('article',['post' => $post]);

    }
}
