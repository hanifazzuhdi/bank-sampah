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
            'image'        => env('APP_URL') . asset('/img/plastic.png')
        ]);

        Jenis::create([
            'jenis_sampah' => 'Kertas',
            'harga'        => '700',
            'image'        => env('APP_URL') . asset('/img/paper.png')
        ]);

        Jenis::create([
            'jenis_sampah' => 'Logam',
            'harga'        => '2000',
            'image'        => env('APP_URL') . asset('/img/beam.png')
        ]);

        Jenis::create([
            'jenis_sampah' => 'Elektronik',
            'harga'        => '5000',
            'image'        => env('APP_URL') . asset('/img/flash.png')
        ]);

        Jenis::create([
            'jenis_sampah' => 'Minyak',
            'harga'        => '3000',
            'image'        => env('APP_URL') . asset('/img/oil.png')
        ]);
    }
}
