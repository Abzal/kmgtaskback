<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            FieldSeeder::class,
            WellTypeSeeder::class,
            WellStatusSeeder::class,
            HorizonSeeder::class,
            WellSeeder::class,
            AuthSeeder::class
        ]);
    }
}
