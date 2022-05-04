<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        $destinations = collect([ 
            // name,        price,  start_at,     end_at
            ['Padang',      250000, '2022-06-04', '2022-06-05'],
            ['Bali',        250000, '2022-06-24', '2022-06-26'],
            ['Palembang',   250000, '2022-07-15', '2022-07-17'],
            ['Bogor',       250000, '2022-08-06', '2022-08-07'],
            ['Yogyakarta',  250000, '2022-09-17', '2022-09-18'],
            ['Mandalika',   250000, '2022-11-04', '2022-11-06'],
            ['Makssar',     250000, '2022-11-18', '2022-11-20'],
            ['Jakarta',     250000, '2022-11-27', '2022-11-27'],
        ]);

        $destinations->each(fn($item) => Destination::create([
            'name'      => $item[0],
            'price'     => $item[1],
            'start_at'  => $item[2],
            'end_at'    => $item[3],
        ]));
    }
}
