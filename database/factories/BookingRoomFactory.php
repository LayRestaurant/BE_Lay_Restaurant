<?php
namespace Database\Factories;

use App\Models\BookingRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingRoomFactory extends Factory
{
    protected $model = BookingRoom::class;

    public function definition()
    {
        $checkInDate = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $numberOfDays = $this->faker->numberBetween(1, 14);
        $checkOutDate = (clone $checkInDate)->modify("+{$numberOfDays} days");

        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'room_id' => $this->faker->numberBetween(1, 15),
            'check_in_date' => $checkInDate->format('Y-m-d H:i:s'),
            'check_out_date' => $checkOutDate->format('Y-m-d H:i:s'),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'status' => 'booked',
            'payment_status' => $this->faker->boolean,
            'number_of_days' => $numberOfDays,
        ];
    }
}

