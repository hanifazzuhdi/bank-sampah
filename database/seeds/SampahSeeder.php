<?php

use App\Model\Sampah;
use Illuminate\Database\Seeder;

class SampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sampah::create([
            'jenis_sampah' => '1',
            'berat'        => '0'
        ]);

        Sampah::create([
            'jenis_sampah' => '2',
            'berat'        => '0'
        ]);

        Sampah::create([
            'jenis_sampah' => '3',
            'berat'        => '0'
        ]);

        Sampah::create([
            'jenis_sampah' => '4',
            'berat'        => '0'
        ]);

        Sampah::create([
            'jenis_sampah' => '5',
            'berat'        => '0'
        ]);
    }
}
