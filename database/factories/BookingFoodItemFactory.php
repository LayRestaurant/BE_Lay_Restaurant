<?php
namespace Database\Factories;

use App\Models\BookingFood;
use App\Models\BookingFoodItem;
use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFoodItemFactory extends Factory
{
    protected $model = BookingFoodItem::class;

    public function definition()
    {
        $quantity = $this->faker->numberBetween(1, 5);
        $price = $this->faker->randomFloat(2, 1, 20);

        return [
            'booking_id' => BookingFood::factory(),
            'food_id' => Food::factory(),
            'quantity' => $quantity,
            'price' => $price,
            'total_price' => $quantity * $price,
        ];
    }
}
