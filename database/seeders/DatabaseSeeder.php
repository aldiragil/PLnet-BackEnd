<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        $this->call(WorkOrderSeeder::class);
        $this->call(MenuSeeder::class);

        User::create([
            'id'        => 0,
            'tipe_id'   => 1,
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'password'  => 'admin'
        ]);

    }
}
