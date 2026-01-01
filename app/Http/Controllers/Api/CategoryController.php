<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            // Add more fields as needed, e.g., 'slug' => 'required|unique:categories,slug',
        ]);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            // Add other fields as needed
        ]);

        $category->update($validated);

        return $category;
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}