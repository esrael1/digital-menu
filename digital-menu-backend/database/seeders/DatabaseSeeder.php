<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(3)->create()->each(function ($user) {

            // Each user has categories
            $categories = Category::factory(4)->create([
                'user_id' => $user->id
            ]);

            // Each category has menu items
            $categories->each(function ($category) {
                MenuItem::factory(6)->create([
                    'category_id' => $category->id
                ]);
            });

        });
    }
}
