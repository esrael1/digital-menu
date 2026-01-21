<?php

namespace App\Http\Controllers;

use App\Models\User;

class PublicMenuController extends Controller
{
    public function show($slug)
    {
        $user = User::where('slug', $slug)
            ->with(['categories.menuItems'])
            ->firstOrFail();

        return response()->json([
            'business_name' => $user->business_name,
            'categories' => $user->categories
        ]);
    }
}
