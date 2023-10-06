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
            'id'        => 1,
            'name'      => "Administrator",
        ]);

        MenuRole::create([
            'id'        => 2,
            'name'      => "Customer",
        ]);

        MenuRole::create([
            'id'        => 3,
            'name'      => "Collector",
        ]);

        MenuRole::create([
            'id'        => 4,
            'name'      => "Teknisi",
        ]);

        MenuRole::create([
            'id'        => 5,
            'name'      => "NOC",
        ]);

        // 1 Menu Master Order Pemasangan Internet
        Menu::create([
            'id'        => 1,
            'parent_id' => 0,
            'menu'      => 'Order',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 2,
                'parent_id' => 1,
                'menu'      => 'Work Order',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 1
            ]);
                Menu::create([
                    'id'        => 3,
                    'parent_id' => 2,
                    'menu'      => 'Ticketing',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 1
                ]);
                Menu::create([
                    'id'        => 4,
                    'parent_id' => 2,
                    'menu'      => 'Kinerja',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 2
                ]);
                Menu::create([
                    'id'        => 5,
                    'parent_id' => 2,
                    'menu'      => 'Tracking User',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 3
                ]);
                Menu::create([
                    'id'        => 6,
                    'parent_id' => 2,
                    'menu'      => 'Setting',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 4
                ]);

            Menu::create([
                'id'        => 7,
                'parent_id' => 1,
                'menu'      => 'Master ODP',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 3
            ]);
                Menu::create([
                    'id'        => 8,
                    'parent_id' => 7,
                    'menu'      => 'ODP',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 2
                ]);
                Menu::create([
                    'id'        => 9,
                    'parent_id' => 7,
                    'menu'      => 'Report',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 2
                ]);
                Menu::create([
                    'id'        => 10,
                    'parent_id' => 7,
                    'menu'      => 'Setting',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 2
                ]);


            Menu::create([
                'id'        => 11,
                'parent_id' => 1,
                'menu'      => 'Customer',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 4
            ]);
                Menu::create([
                    'id'        => 12,
                    'parent_id' => 11,
                    'menu'      => 'List',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 1
                ]);
                Menu::create([
                    'id'        => 13,
                    'parent_id' => 11,
                    'menu'      => 'Setting',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 3
                ]);

            Menu::create([
                'id'        => 14,
                'parent_id' => 1,
                'menu'      => 'Survey',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
                Menu::create([
                    'id'        => 15,
                    'parent_id' => 14,
                    'menu'      => 'List',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 4
                ]);
                Menu::create([
                    'id'        => 16,
                    'parent_id' => 14,
                    'menu'      => 'Report',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 4
                ]);
                Menu::create([
                    'id'        => 17,
                    'parent_id' => 14,
                    'menu'      => 'Setting',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 4
                ]);

            Menu::create([
                'id'        => 18,
                'parent_id' => 1,
                'menu'      => 'Pemasangan',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
                Menu::create([
                    'id'        => 19,
                    'parent_id' => 18,
                    'menu'      => 'Pasang',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 5
                ]);
                Menu::create([
                    'id'        => 20,
                    'parent_id' => 18,
                    'menu'      => 'Berhenti',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 5
                ]);


        // 2. Menu Master NOC
        Menu::create([
            'id'        => 21,
            'parent_id' => '0',
            'menu'      => 'NOC',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 22,
                'parent_id' => 21,
                'menu'      => 'Approval Pemasangan',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 23,
                'parent_id' => 21,
                'menu'      => 'Approval Berhenti',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 24,
                'parent_id' => 21,
                'menu'      => 'Report Redaman',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 25,
                'parent_id' => 21,
                'menu'      => 'Setting',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);


        // 3. Menu Master Receivable
        Menu::create([
            'id'        => 26,
            'parent_id' => '0',
            'menu'      => 'Receivable',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 27,
                'parent_id' => 26,
                'menu'      => 'Invoice',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);

            Menu::create([
                'id'        => 28,
                'parent_id' => 26,
                'menu'      => 'Mapping',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
                Menu::create([
                    'id'        => 29,
                    'parent_id' => 28,
                    'menu'      => 'List',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 5
                ]);
                Menu::create([
                    'id'        => 30,
                    'parent_id' => 28,
                    'menu'      => 'Rute Tagih',
                    'tipe_id'      => 1,
                    'icon'      => '',
                    'order'     => 5
                ]);


            Menu::create([
                'id'        => 31,
                'parent_id' => 26,
                'menu'      => 'Reminder',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 32,
                'parent_id' => 26,
                'menu'      => 'Pending Koleksi',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 33,
                'parent_id' => 26,
                'menu'      => 'Pembayaran',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 34,
                'parent_id' => 26,
                'menu'      => 'Report',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 35,
                'parent_id' => 26,
                'menu'      => 'Setting',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);


        // 4. Menu Master Inventory
        Menu::create([
            'id'        => 36,
            'parent_id' => '0',
            'menu'      => 'Inventory',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 1
        ]);
            Menu::create([
                'id'        => 37,
                'parent_id' => 36,
                'menu'      => 'Gudang',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);
            Menu::create([
                'id'        => 38,
                'parent_id' => 36,
                'menu'      => 'Report',
                'tipe_id'      => 1,
                'icon'      => '',
                'order'     => 5
            ]);


        // 5. Menu Master Penjualan
        Menu::create([
            'id'        => 39,
            'parent_id' => '0',
            'menu'      => 'Penjualan',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 1
        ]);


        // 6. Menu Master Customer
        Menu::create([
            'id'        => 40,
            'parent_id' => 0,
            'menu'      => 'Pengaduan',
            'tipe_id'      => 2,
            'icon'      => '',
            'order'     => 1
        ]);
        Menu::create([
            'id'        => 41,
            'parent_id' => 0,
            'menu'      => 'Info Tagihan',
            'tipe_id'      => 2,
            'icon'      => '',
            'order'     => 3
        ]);
        Menu::create([
            'id'        => 42,
            'parent_id' => 0,
            'menu'      => 'Laporan Isolir',
            'tipe_id'      => 2,
            'icon'      => '',
            'order'     => 4
        ]);

        Menu::create([
            'id'        => 43,
            'parent_id' => 2,
            'menu'      => 'Ticketing List',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 2
        ]);

        Menu::create([
            'id'        => 44,
            'parent_id' => 1,
            'menu'      => 'Pemutusan',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 5
        ]);

        Menu::create([
            'id'        => 45,
            'parent_id' => 11,
            'menu'      => 'List Pengaduan',
            'tipe_id'      => 1,
            'icon'      => '',
            'order'     => 2
        ]);

        $menu = Menu::create([
            'id'        => 46,
            'parent_id' => 0,
            'menu'      => 'Report Pengaduan',
            'tipe_id'      => 2,
            'icon'      => '',
            'order'     => 2
        ]);

        

        for ($i=1; $i <= $menu->id; $i++) { 
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

        MenuAccess::create([
            'tipe_id'   => 4,
            'menu_id' => 1,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 4,
            'menu_id' => 11,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 4,
            'menu_id' => 15,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 4,
            'menu_id' => 18,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 4,
            'menu_id' => 43,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 5,
            'menu_id' => 1,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 5,
            'menu_id' => 11,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 5,
            'menu_id' => 15,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 5,
            'menu_id' => 18,
        ]);  
        MenuAccess::create([
            'tipe_id'   => 5,
            'menu_id' => 43,
        ]); 

    }
}
