<?php

namespace Database\Factories;

use App\Models\ShoppingCart;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShoppingCartFactory extends Factory
{
    protected $model = ShoppingCart::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // Adjust as per your User model
            'food_id' => \App\Models\Food::factory(), // Adjust as per your Food model
            'quantity' => $this->faker->numberBetween(1, 10),
            'total_price' => $this->faker->randomFloat(2, 10, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
