<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\WorkOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Work Order Category
        Setting::create([
            'id' => 13,
            'group' => 'WorkOrder',
            'key' => 'Kategori',
            'value' => 'Gangguan',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 14,
            'group' => 'WorkOrder',
            'key' => 'Kategori',
            'value' => 'Pasang Baru',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 15,
            'group' => 'WorkOrder',
            'key' => 'Kategori',
            'value' => 'Survey',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 16,
            'group' => 'WorkOrder',
            'key' => 'Kategori',
            'value' => 'Setup Jaringan',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 17,
            'group' => 'WorkOrder',
            'key' => 'Kategori',
            'value' => 'Berhenti Berlangganan',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 18,
            'group' => 'WorkOrder',
            'key' => 'Kategori',
            'value' => 'Antar Voucher',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // Work Order Level
        Setting::create([
            'id' => 19,
            'group' => 'WorkOrder',
            'key' => 'Level',
            'value' => 'Low',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 20,
            'group' => 'WorkOrder',
            'key' => 'Level',
            'value' => 'Medium',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 21,
            'group' => 'WorkOrder',
            'key' => 'Level',
            'value' => 'High',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
