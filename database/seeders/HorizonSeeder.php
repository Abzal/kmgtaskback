<?php

namespace Database\Seeders;

use App\Models\Horizons;
use Illuminate\Database\Seeder;

class HorizonSeeder extends Seeder
{
    public function run()
    {
        $horizons = [
            [ 'I', 0.01 ],
            [ 'II', 0.03 ],
            [ 'III', 0.05 ],
            [ 'IV', 0.01 ],
            [ 'V', 0.03 ]
        ];

        foreach ($horizons as $horizon) {
            Horizons::create([
                'name' => $horizon[0],
                'coefficient' => $horizon[1]
            ]);
        }
    }
}
