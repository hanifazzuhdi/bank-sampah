<?php

use App\Model\Jenis;
use App\Model\Role;
use App\User;
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
    }
}
