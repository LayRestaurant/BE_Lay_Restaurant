<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        DB::table('roles')->insert([
            'name' => ['admin', 'customer', 'expert'][array_rand(['admin', 'customer', 'expert'])],
        ]);

    }
}
