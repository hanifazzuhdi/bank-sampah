<?php

use App\Model\Jenis;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jenis::create([
            'jenis_sampah' => 'Plastik',
            'harga'        => '500'
        ]);

        Jenis::create([
            'jenis_sampah' => 'kertas',
            'harga'        => '700'
        ]);

        Jenis::create([
            'jenis_sampah' => 'logam',
            'harga'        => '2000'
        ]);

        Jenis::create([
            'jenis_sampah' => 'Elektronik',
            'harga'        => '5000'
        ]);

        Jenis::create([
            'jenis_sampah' => 'Minyak',
            'harga'        => '3000'
        ]);
    }
}
