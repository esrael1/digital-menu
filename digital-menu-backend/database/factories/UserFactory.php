<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $businessName = $this->faker->company;

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'business_name' => $businessName,
            'tin' => $this->faker->numerify('##########'),
            'slug' => Str::slug($businessName) . '-' . uniqid(),
            'password' => Hash::make('password'), // default password
        ];
    }
}
