<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuAccess;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // 1 Menu Master Order Pemasangan Internet
        Menu::create([
            'id'        => 0,
            'parent_id' => 0,
            'menu'      => 'Order',
            'tipe'      => 'Employee',
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 1,
                'menu'      => 'Work Order',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 1
            ]);

            Menu::create([
                'id'        => 0,
                'parent_id' => 1,
                'menu'      => 'ODP',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 2
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 1,
                'menu'      => 'Customer',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 3
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 1,
                'menu'      => 'Survey',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 4
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => '0',
                'menu'      => 'Pemasangan',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);


        // 2. Menu Master NOC
        Menu::create([
            'id'        => 0,
            'parent_id' => '0',
            'menu'      => 'NOC',
            'tipe'      => 'Employee',
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 7,
                'menu'      => 'Approval Pemasangan',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 7,
                'menu'      => 'Approval Berhenti',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 7,
                'menu'      => 'Report Redaman',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 7,
                'menu'      => 'Setting',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);


        // 3. Menu Master Receivable
        Menu::create([
            'id'        => 0,
            'parent_id' => '0',
            'menu'      => 'Receivable',
            'tipe'      => 'Employee',
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 12,
                'menu'      => 'Invoice',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 12,
                'menu'      => 'Mapping',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 12,
                'menu'      => 'Reminder',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 12,
                'menu'      => 'Pending Koleksi',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 12,
                'menu'      => 'Pending Koleksi',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 12,
                'menu'      => 'Pembayaran',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 12,
                'menu'      => 'Report',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 12,
                'menu'      => 'Setting',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);


        // 4. Menu Master Inventory
        Menu::create([
            'id'        => 0,
            'parent_id' => '0',
            'menu'      => 'Inventory',
            'tipe'      => 'Employee',
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 21,
                'menu'      => 'Gudang',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 21,
                'menu'      => 'Terjual',
                'tipe'      => 'Employee',
                'icon'      => '',
                'order'     => 5
            ]);


        // 5. Menu Master Penjualan
        Menu::create([
            'id'        => 0,
            'parent_id' => '0',
            'menu'      => 'Penjualan',
            'tipe'      => 'Employee',
            'icon'      => '',
            'order'     => 1
        ]);


        // 6. Menu Master Customer
        Menu::create([
            'id'        => 0,
            'parent_id' => 0,
            'menu'      => 'Pengaduan',
            'tipe'      => 'Customer',
            'icon'      => '',
            'order'     => 1
        ]);
        Menu::create([
            'id'        => 0,
            'parent_id' => 0,
            'menu'      => 'Info Tagihan',
            'tipe'      => 'Customer',
            'icon'      => '',
            'order'     => 1
        ]);
        $menu = Menu::create([
            'id'        => 0,
            'parent_id' => 0,
            'menu'      => 'Laporan Isolir',
            'tipe'      => 'Customer',
            'icon'      => '',
            'order'     => 2
        ]);
        
        for ($i=0; $i < $menu->id; $i++) { 
            MenuAccess::create([
                'user_id'   => 1,
                'menu_id' => $i,
            ]);  
        }



    }
}
