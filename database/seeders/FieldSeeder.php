<?php

namespace Database\Seeders;

use App\Models\Fields;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    public function run()
    {
        $fields = ['AA', 'BB', 'CC'];

        foreach ($fields as $field) {
            Fields::create(['name' => $field]);
        }
    }
}
