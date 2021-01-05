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
            'berat'        => '10',
        ]);

        Sampah::create([
            'jenis_sampah' => '2',
            'berat'        => '15',
        ]);

        Sampah::create([
            'jenis_sampah' => '3',
            'berat'        => '5'
        ]);

        Sampah::create([
            'jenis_sampah' => '4',
            'berat'        => '9'
        ]);

        Sampah::create([
            'jenis_sampah' => '5',
            'berat'        => '20'
        ]);
    }
}
