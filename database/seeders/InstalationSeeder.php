<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\DueDate;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Time;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstalationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::create([
            'id' => 0,
            'name' => 'PaKet 1',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Package::create([
            'id' => 0,
            'name' => 'PaKet 2',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Package::create([
            'id' => 0,
            'name' => 'PaKet 3',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DueDate::create([
            'id' => 0,
            'time_id' => 1,
            'number' => 30
        ]);
        DueDate::create([
            'id' => 0,
            'time_id' => 2,
            'number' => 4
        ]);
        DueDate::create([
            'id' => 0,
            'time_id' => 3,
            'number' => 1
        ]);
        Time::create([
            'id' => 0,
            'name' => 'Hari',
        ]);
        Time::create([
            'id' => 0,
            'name' => 'Minggu',
        ]);
        Time::create([
            'id' => 0,
            'name' => 'Bulan',
        ]);
        Time::create([
            'id' => 0,
            'name' => 'Tahun',
        ]);

    }
}
