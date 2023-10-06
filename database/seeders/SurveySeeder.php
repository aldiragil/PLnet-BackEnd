<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'id' => 10,
            'group' => 'Survey',
            'key' => 'Paket',
            'value' => 'Paket 1',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 11,
            'group' => 'Survey',
            'key' => 'Area',
            'value' => 'Paket 2',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 12,
            'group' => 'Survey',
            'key' => 'Area',
            'value' => 'Paket 3',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
