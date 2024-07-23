<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookingFood;

class BookingFoodSeeder extends Seeder
{
    public function run()
    {
        BookingFood::factory()
            ->count(10)
            ->hasItems(3) // Assuming you want each booking to have 3 items
            ->create();
    }
}
