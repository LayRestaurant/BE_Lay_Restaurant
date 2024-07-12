<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShoppingCart;

class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShoppingCart::factory()->count(10)->create();
    }
}
