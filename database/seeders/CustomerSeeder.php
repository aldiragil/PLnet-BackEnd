<?php

namespace Database\Seeders;

use App\Models\Customer;
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
            'id'        => 0,
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
            'id'        => 0,
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
            'id'        => 0,
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
    }
}
