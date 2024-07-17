<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Booking;
use App\Models\Comment;
use App\Models\ExpertDetail;
use App\Models\Food;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\ExpertDetailsSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            ContactSeeder::class,
            ExpertDetailsSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            CalendarSeeder::class,
            BookingSeeder::class,
            FeedbackSeeder::class,
            FoodSeeder::class,
            // MessageSeeder::class,
        ]);

    }
}
