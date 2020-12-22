<?php

use App\Model\Jenis;
use App\Model\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_name' => 'nasabah'
        ]);

        Role::create([
            'role_name' => 'pengurus_1'
        ]);

        Role::create([
            'role_name' => 'pengurus_2'
        ]);

        Role::create([
            'role_name' => 'bendahara'
        ]);

        Role::create([
            'role_name' => 'admin'
        ]);

        // Jenis::create([
        //     'jenis_sampah' => 'Plastik',
        //     'harga'        => '500'
        // ]);

        // Jenis::create([
        //     'jenis_sampah' => 'kertas',
        //     'harga'        => '700'
        // ]);

        // Jenis::create([
        //     'jenis_sampah' => 'logam',
        //     'harga'        => '2000'
        // ]);

        // Jenis::create([
        //     'jenis_sampah' => 'Elektronik',
        //     'harga'        => '5000'
        // ]);

        // Jenis::create([
        //     'jenis_sampah' => 'Minyak',
        //     'harga'        => '3000'
        // ]);
    }
}
