<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookingFood;
use App\Models\BookingFoodItem;
use App\Models\Food;

class BookingFoodItemSeeder extends Seeder
{
    public function run()
    {
        $bookings = BookingFood::all();
        $foods = Food::all();

        foreach ($bookings as $booking) {
            $numberOfItems = rand(1, 5); // Randomly decide the number of items per booking

            for ($i = 0; $i < $numberOfItems; $i++) {
                $food = $foods->random();
                $quantity = rand(1, 5);
                $price = $food->price;
                $totalPrice = $quantity * $price;

                BookingFoodItem::create([
                    'booking_id' => $booking->id,
                    'food_id' => $food->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total_price' => $totalPrice,
                ]);
            }
        }
    }
}
