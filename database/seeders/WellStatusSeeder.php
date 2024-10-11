<?php

namespace Database\Seeders;

use App\Models\WellStatuses;
use Illuminate\Database\Seeder;

class WellStatusSeeder extends Seeder
{
    public function run()
    {
        $wellStatuses = ['В работе', 'В простое', 'Наблюдательная'];

        foreach ($wellStatuses as $wellStatus) {
            WellStatuses::create(['name' => $wellStatus]);
        }
    }
}
