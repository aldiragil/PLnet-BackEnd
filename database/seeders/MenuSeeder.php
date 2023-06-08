<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuAccess;
use App\Models\MenuRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        MenuRole::create([
            'id'        => 0,
            'name'      => "Administrator",
        ]);

        MenuRole::create([
            'id'        => 0,
            'name'      => "Customer",
        ]);

        MenuRole::create([
            'id'        => 0,
            'name'      => "Collector",
        ]);

        MenuRole::create([
            'id'        => 0,
            'name'      => "Teknisi",
        ]);

        MenuRole::create([
            'id'        => 0,
            'name'      => "NOC",
        ]);

        // 1 Menu Master Order Pemasangan Internet
        Menu::create([
            'id'        => 0,
            'parent_id' => 0,
            'menu'      => 'Order',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 1,
                'menu'      => 'Work Order',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 1
            ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 2,
                    'menu'      => 'List',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 1
                ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 2,
                    'menu'      => 'Kinerja',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 1
                ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 2,
                    'menu'      => 'Tracking User',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 1
                ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 2,
                    'menu'      => 'Setting',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 1
                ]);

            Menu::create([
                'id'        => 0,
                'parent_id' => 1,
                'menu'      => 'Master ODP',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 2
            ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 7,
                    'menu'      => 'ODP',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 2
                ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 7,
                    'menu'      => 'Report',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 2
                ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 7,
                    'menu'      => 'Setting',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 2
                ]);


            Menu::create([
                'id'        => 0,
                'parent_id' => 1,
                'menu'      => 'Customer',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 3
            ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 11,
                    'menu'      => 'List',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 3
                ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 11,
                    'menu'      => 'Setting',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 3
                ]);

            Menu::create([
                'id'        => 0,
                'parent_id' => 1,
                'menu'      => 'Survey',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 4
            ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 14,
                    'menu'      => 'List',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 4
                ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 14,
                    'menu'      => 'Report',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 4
                ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 14,
                    'menu'      => 'Setting',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 4
                ]);

            Menu::create([
                'id'        => 0,
                'parent_id' => 1,
                'menu'      => 'Pemasangan',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 18,
                    'menu'      => 'Pasang',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 5
                ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 18,
                    'menu'      => 'Berhenti',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 5
                ]);


        // 2. Menu Master NOC
        Menu::create([
            'id'        => 0,
            'parent_id' => '0',
            'menu'      => 'NOC',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 21,
                'menu'      => 'Approval Pemasangan',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 21,
                'menu'      => 'Approval Berhenti',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 21,
                'menu'      => 'Report Redaman',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 21,
                'menu'      => 'Setting',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);


        // 3. Menu Master Receivable
        Menu::create([
            'id'        => 0,
            'parent_id' => '0',
            'menu'      => 'Receivable',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 26,
                'menu'      => 'Invoice',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);

            Menu::create([
                'id'        => 0,
                'parent_id' => 26,
                'menu'      => 'Mapping',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 28,
                    'menu'      => 'List',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 5
                ]);
                Menu::create([
                    'id'        => 0,
                    'parent_id' => 28,
                    'menu'      => 'Rute Tagih',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 5
                ]);


            Menu::create([
                'id'        => 0,
                'parent_id' => 26,
                'menu'      => 'Reminder',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 26,
                'menu'      => 'Pending Koleksi',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 26,
                'menu'      => 'Pembayaran',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 26,
                'menu'      => 'Report',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 26,
                'menu'      => 'Setting',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);


        // 4. Menu Master Inventory
        Menu::create([
            'id'        => 0,
            'parent_id' => '0',
            'menu'      => 'Inventory',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 36,
                'menu'      => 'Gudang',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 0,
                'parent_id' => 36,
                'menu'      => 'Report',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);


        // 5. Menu Master Penjualan
        Menu::create([
            'id'        => 0,
            'parent_id' => '0',
            'menu'      => 'Penjualan',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 1
        ]);


        // 6. Menu Master Customer
        Menu::create([
            'id'        => 0,
            'parent_id' => 0,
            'menu'      => 'Pengaduan',
            'tipe_id'      => 2,
            'icon'      => '',
            'order'     => 1
        ]);
        Menu::create([
            'id'        => 0,
            'parent_id' => 0,
            'menu'      => 'Info Tagihan',
            'tipe_id'      => 2,
            'icon'      => '',
            'order'     => 1
        ]);
        $menu = Menu::create([
            'id'        => 0,
            'parent_id' => 0,
            'menu'      => 'Laporan Isolir',
            'tipe_id'      => 2,
            'icon'      => '',
            'order'     => 2
        ]);
        
        for ($i=0; $i < $menu->id; $i++) { 
            MenuAccess::create([
                'tipe_id'   => 1,
                'menu_id' => $i,
            ]);  
        }

        MenuAccess::create([
            'tipe_id'   => 3,
            'menu_id' => 1,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 3,
            'menu_id' => 2,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 3,
            'menu_id' => 3,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 3,
            'menu_id' => 4,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 3,
            'menu_id' => 5,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 3,
            'menu_id' => 6,
        ]);  


    }
}
