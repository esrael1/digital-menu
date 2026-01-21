<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * List items grouped by category (with search)
     */
    public function index(Request $request)
    {
        $query = Category::where('user_id', $request->user()->id)
            ->with(['menuItems' => function ($q) use ($request) {
                if ($request->search) {
                    $q->where('item_name', 'like', '%' . $request->search . '%');
                }
            }]);

        return response()->json($query->get());
    }

    /**
     * Store menu item
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'item_name' => 'required|string',
            'price' => 'required|numeric',
            'tax_percentage' => 'nullable|numeric',
            'photo' => 'nullable|string'
        ]);

        // Authorization (category owner check)
        $category = Category::findOrFail($validated['category_id']);
        if ($category->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $tax = $validated['tax_percentage'] ?? 0;
        $finalPrice = $validated['price'] + ($validated['price'] * $tax / 100);

        $item = MenuItem::create([
            ...$validated,
            'tax_percentage' => $tax,
            'final_price' => $finalPrice
        ]);

        return response()->json([
            'message' => 'Menu item created',
            'item' => $item
        ], 201);
    }

    /**
     * Delete menu item
     */
    public function destroy(Request $request, $id)
    {
        $item = MenuItem::findOrFail($id);

        if ($item->category->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $item->delete();

        return response()->json(['message' => 'Menu item deleted']);
    }
}
