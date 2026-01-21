<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display all categories for logged-in user
     */
    public function index(Request $request)
    {
        return response()->json(
            Category::where('user_id', $request->user()->id)->get()
        );
    }

    /**
     * Store a new category
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $category = Category::create([
            'user_id' => $request->user()->id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category
        ], 201);
    }

    /**
     * Update category (only owner)
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Authorization check
        if ($category->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category
        ]);
    }

    /**
     * Delete category (only owner)
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Authorization check
        if ($category->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
