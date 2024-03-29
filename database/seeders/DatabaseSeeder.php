<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Instalation;
use App\Models\MasterOdp;
use App\Models\Payment;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(InstalationSeeder::class);
        $this->call(MasterOdpSeeder::class);
        $this->call(WorkOrderSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(MenuSeeder::class);

        User::create([
            'id'        => 1,
            'tipe_id'   => 1,
            'team_id'   => 1,
            'code'      => 'ADMIN1111',
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'password'  => 'admin'
        ]);
        User::create([
            'id'        => 2,
            'tipe_id'   => 4,
            'team_id'   => 1,
            'code'      => 'EMP1111',
            'name'      => 'Pegawai 1',
            'email'     => 'pegawai1@admin.com',
            'password'  => 'admin'
        ]);
        User::create([
            'id'        => 3,
            'tipe_id'   => 4,
            'team_id'   => 1,
            'code'      => 'EMP2222',
            'name'      => 'Pegawai 2',
            'email'     => 'pegawai2@admin.com',
            'password'  => 'admin'
        ]);
        User::create([
            'id'        => 4,
            'tipe_id'   => 3,
            'team_id'   => 2,
            'code'      => 'EMP3333',
            'name'      => 'Pegawai 3',
            'email'     => 'pegawai3@admin.com',
            'password'  => 'admin'
        ]);
        Team::create([
            'id'        => 1,
            'name'      => 'Team 1'
        ]);
        Team::create([
            'id'        => 2,
            'name'      => 'Team 2'
        ]);
        Payment::create([
            'id'        => 3,
            'name'      => 'Pra Bayar'
        ]);
        Payment::create([
            'id'        => 4,
            'name'      => 'Pasca Bayar'
        ]);
        Payment::create([
            'id'        => 5,
            'name'      => 'Pasca Bayar Put Off'
        ]);

    }
}
