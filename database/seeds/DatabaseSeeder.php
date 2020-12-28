<?php

use App\Model\Keuangan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Keuangan::create([
            'keterangan' => 'dana dari investor',
            'debet'      => '10000000000',
            'kredit'     => 0,
            'saldo'      => '10000000000'
        ]);

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JenisSeeder::class);
        $this->call(SampahSeeder::class);
    }
}
