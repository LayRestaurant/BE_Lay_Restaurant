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
            'price' => $this->faker->randomFloat(2, 50, 500),
            'capacity' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['available', 'booked']),
            'star_rating' => $this->faker->numberBetween(0, 5),
            'room_type' => $this->faker->randomElement(['single', 'double', 'multiple']),
            'most_booked_room' => $this->faker->boolean,
            'restaurant_name' => $this->faker->company,
            'image1' => $this->faker->imageUrl,
            'image2' => $this->faker->imageUrl,
            'image3' => $this->faker->imageUrl,
        ];
    }
}
