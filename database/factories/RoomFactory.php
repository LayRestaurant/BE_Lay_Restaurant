<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'regularPrice' => $this->faker->randomFloat(2, 100, 500), // Regular price field
            'maxCapacity' => $this->faker->numberBetween(1, 4), // Maximum capacity field
            'price' => $this->faker->randomFloat(2, 80, 450), // Optional discounted price
            'discount' => $this->faker->numberBetween(0, 50), // Discount field
            'status' => $this->faker->randomElement(['available', 'booked']),
            'star_rating' => $this->faker->numberBetween(0, 5),
            'room_type' => $this->faker->randomElement(['single', 'double', 'multiple']),
            'most_booked_room' => $this->faker->boolean,
            'restaurant_name' => $this->faker->company,
            'image1' => $this->faker->imageUrl,
            'image2' => $this->faker->imageUrl,
            'image3' => $this->faker->imageUrl,
            'image' => $this->faker->imageUrl,
        ];
    }
}
