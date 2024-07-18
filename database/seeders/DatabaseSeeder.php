<?php

namespace Database\Seeders;
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
            RoomSeeder::class
            // MessageSeeder::class,
        ]);

    }
}
