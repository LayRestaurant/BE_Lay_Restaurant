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
            'guest_id' => $this->faker->numberBetween(1, 10), // Thêm guest_id
            'room_id' => $this->faker->numberBetween(1, 15), // Thêm room_id
            'check_in_date' => $checkInDate->format('Y-m-d H:i:s'), // Ngày nhận phòng
            'check_out_date' => $checkOutDate->format('Y-m-d H:i:s'), // Ngày trả phòng
            'number_of_days' => $numberOfDays, // Số ngày ở
            'number_of_guests' => $this->faker->numberBetween(1, 4), // Số lượng khách
            'total_price' => $this->faker->randomFloat(2, 50, 500), // Tổng giá cho booking
            'status' => 'booked', // Trạng thái booking
            'payment_status' => $this->faker->boolean, // Trạng thái thanh toán
            'notes' => $this->faker->sentence(), // Các ghi chú bổ sung
        ];
    }
}
