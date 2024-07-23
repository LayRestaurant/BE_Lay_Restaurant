<?php
namespace Database\Factories;

use App\Models\BookingFood;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookingFoodFactory extends Factory
{
    protected $model = BookingFood::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'order_number' => Str::uuid(),
            'order_date' => $this->faker->dateTime(),
            'total_amount' => $this->faker->randomFloat(2, 10, 100),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'payment_method' => $this->faker->randomElement(['cash', 'credit card', 'VNpay']),
            'delivery_address' => $this->faker->address(),
            'note' => $this->faker->optional()->sentence(),
        ];
    }
}
