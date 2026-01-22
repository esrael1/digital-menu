<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    public function definition(): array
    {
        $price = $this->faker->randomFloat(2, 20, 300);
        $tax = $this->faker->randomElement([0, 5, 10, 15]);

        return [
            'category_id' => Category::factory(),
            'item_name' => $this->faker->words(2, true),
            'price' => $price,
            'tax_percentage' => $tax,
            'final_price' => $price + ($price * $tax / 100),
            'photo' => null,
        ];
    }
}
