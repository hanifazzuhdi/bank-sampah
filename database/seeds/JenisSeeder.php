<?php

use App\Model\Jenis;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
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
            'harga'        => '500',
            'image'        => asset('/img/plastic.png'),
            'warna'        => '#2979FF',
        ]);

        Jenis::create([
            'jenis_sampah' => 'Kertas',
            'harga'        => '700',
            'image'        => asset('/img/paper.png'),
            'warna'        => '#90A4AE',
        ]);

        Jenis::create([
            'jenis_sampah' => 'Logam',
            'harga'        => '2000',
            'image'        => asset('/img/beam.png'),
            'warna'        => '#3F51B5',
        ]);

        Jenis::create([
            'jenis_sampah' => 'Elektronik',
            'harga'        => '5000',
            'image'        => asset('/img/flash.png'),
            'warna'        => '#FFA000',
        ]);

        Jenis::create([
            'jenis_sampah' => 'Minyak',
            'harga'        => '3000',
            'image'        => asset('/img/oil.png'),
            'warna'        => '#FFFF00',
        ]);
    }
}
