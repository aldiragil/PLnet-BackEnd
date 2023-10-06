<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'id'        => 1,
            'user_id'   => NULL,
            'group_id'   => 1,
            'payment_id'   => 1,
            'code'      => '1111',
            'nik'      => '3510101010101010',
            'name'     => 'Customer 1',
            'location'  => 'Surabaya',
            'latitude'  => '1234567890',
            'longitude'  => '1234567890',
            'phone'  => '0812222222',
            'area'  => 'Surabaya',
            'barcode'  => '1234567890',
            'active'  => 1,
            'status'  => 1,
            'created_by'  => 1,
            'updated_by'  => 1
        ]);
        Customer::create([
            'id'        => 2,
            'user_id'   => NULL,
            'group_id'   => 1,
            'payment_id'   => 1,
            'code'      => '2222',
            'nik'      => '3510101010101010',
            'name'     => 'Customer 2',
            'location'  => 'Surabaya',
            'latitude'  => '1234567890',
            'longitude'  => '1234567890',
            'phone'  => '0812222222',
            'area'  => 'Surabaya',
            'barcode'  => '1234567890',
            'active'  => 1,
            'status'  => 1,
            'created_by'  => 1,
            'updated_by'  => 1
        ]);
        Customer::create([
            'id'        => 3,
            'user_id'   => NULL,
            'group_id'   => 1,
            'payment_id'   => 1,
            'code'      => '3333',
            'nik'      => '3510101010101010',
            'name'     => 'Customer 3',
            'location'  => 'Surabaya',
            'latitude'  => '1234567890',
            'longitude'  => '1234567890',
            'phone'  => '0812222222',
            'area'  => 'Surabaya',
            'barcode'  => '1234567890',
            'active'  => 1,
            'status'  => 1,
            'created_by'  => 1,
            'updated_by'  => 1
        ]);


        Setting::create([
            'id' => 1,
            'group' => 'Customer',
            'key' => 'Area',
            'value' => 'Surabaya',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 2,
            'group' => 'Customer',
            'key' => 'Area',
            'value' => 'Sidoarjo',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Setting::create([
            'id' => 3,
            'group' => 'Customer',
            'key' => 'Area',
            'value' => 'Gresik',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Setting::create([
            'id' => 4,
            'group' => 'Customer',
            'key' => 'Area',
            'value' => 'Gresik',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Setting::create([
            'id' => 5,
            'group' => 'Instalation',
            'key' => 'Event',
            'value' => 'Agustus 50% Off',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Setting::create([
            'id' => 6,
            'group' => 'Instalation',
            'key' => 'Event',
            'value' => 'Gratis Pemasangan',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
