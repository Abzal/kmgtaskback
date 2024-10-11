<?php

namespace Database\Seeders;

use App\Models\WellTypes;
use Illuminate\Database\Seeder;

class WellTypeSeeder extends Seeder
{
    public function run()
    {
        $wellTypes = ['добывающая'];

        foreach ($wellTypes as $wellType) {
            WellTypes::create(['name' => $wellType]);
        }
    }
}
