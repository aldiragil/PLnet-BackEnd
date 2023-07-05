<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterOdpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'id' => 0,
            'group' => 'MasterOdp',
            'key' => 'Perangkat',
            'value' => 'Perangkat 1',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 0,
            'group' => 'MasterOdp',
            'key' => 'Perangkat',
            'value' => 'Perangkat 2',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 0,
            'group' => 'MasterOdp',
            'key' => 'Perangkat',
            'value' => 'Perangkat 3',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
