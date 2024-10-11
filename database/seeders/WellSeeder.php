<?php

namespace Database\Seeders;

use App\Models\Fields;
use App\Models\Horizons;
use App\Models\Well;
use App\Models\WellStatuses;
use App\Models\WellTypes;
use Illuminate\Database\Seeder;

class WellSeeder extends Seeder
{
    public function run()
    {
        $wells = [
            ['AA', '10Д', 'добывающая', 'Наблюдательная', 'V', 11.6, 88.6, 0.83, 0.03, true],
            ['AA', '33Г', 'добывающая', 'В работе', 'I', 1.8, 98.0, 0.82, 0.00, true],
            ['AA', '37Г', 'добывающая', 'В работе', 'II', 12.46, 83.0, 0.83, 0.04, true],
            ['CC', '47', 'добывающая', 'Наблюдательная', 'IV', 20.11, 91.64, 0.82, 0.02, true],
            ['AA', '14', 'добывающая', 'В работе', 'II', 20.33, 50.0, 0.82, 0.21, true],
            ['AA', '26', 'добывающая', 'Наблюдательная', 'II', 9.76, 90.86, 0.83, 0.02, true],
            ['BB', '27', 'добывающая', 'В простое', 'III', 0, 39.92, 0.83, 0.00, true],
            ['AA', '28Г', 'добывающая', 'В простое', 'IV', 7.82, 0, 0.82, 0.09, true],
            ['BB', '29Г', 'добывающая', 'Наблюдательная', 'II', 6.17, 99.99, 0.83, 0.00, true],
            ['BB', '32Г', 'добывающая', 'В работе', 'III', 6.84, 99.99, 0.82, 0.00, true],
            ['CC', '34Г', 'добывающая', 'В простое', 'I', 0, 99.99, 0.83, 0.00, true],
            ['CC', '35Г', 'добывающая', 'В работе', 'V', 16.17, 0, 0.82, 0.41, true],

            // Несохраненные данные
            ['AA', '203', 'добывающая', 'Наблюдательная', 'V', 11.6, 12.73, 0.83, 0.26, false],
            ['AA', '204', 'добывающая', 'В работе', 'I', 1.8, 70.45, 0.82, 0.00, false],
            ['AA', '205', 'добывающая', 'В работе', 'II', 12.46, 25.18, 0.83, 0.19, false],
            ['CC', '206', 'добывающая', 'Наблюдательная', 'IV', 20.11, 90.6, 0.82, 0.02, false],
            ['AA', '208', 'добывающая', 'В работе', 'II', 20.33, 89.57, 0.82, 0.04, false],
            ['AA', '210', 'добывающая', 'Наблюдательная', 'II', 9.76, 92.69, 0.83, 0.01, false],
            ['BB', '211', 'добывающая', 'В простое', 'III', 0, 67.82, 0.83, 0.00, false],
            ['AA', '212', 'добывающая', 'В простое', 'IV', 7.82, 20.27, 0.82, 0.07, false],
            ['BB', '213', 'добывающая', 'Наблюдательная', 'II', 6.17, 43.0, 0.83, 0.07, false],
            ['BB', '215', 'добывающая', 'В работе', 'III', 6.84, 89.77, 0.82, 0.03, false],
            ['CC', '216', 'добывающая', 'В простое', 'I', 0, 48.64, 0.83, 0.00, false],
            ['CC', '219', 'добывающая', 'В работе', 'V', 16.17, 86.86, 0.82, 0.05, false],
        ];


        foreach ($wells as $well) {
            Well::create([
                'field_id' => Fields::where('name', $well[0])->first()->id,
                'well_number' => $well[1],
                'well_type_id' => WellTypes::where('name', $well[2])->first()->id,
                'well_status_id' => WellStatuses::where('name', $well[3])->first()->id,
                'horizon_id' => Horizons::where('name', $well[4])->first()->id,
                'liquid_flow' => $well[5],
                'water_cut' => $well[6],
                'oil_density' => $well[7],
                'oil_rate' => $well[8],
                'is_saved' => $well[9]
            ]);
        }
    }
}

