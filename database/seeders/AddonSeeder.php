<?php

namespace Database\Seeders;

use App\Models\Addon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    public function run()
    {
        $addons = collect([
            ['Vest (size: S)', 150000],
            ['Vest (size: M)', 150000],
            ['Vest (size: L)', 150000],
            ['Vest (size: XL)', 150000],
        ]);
        

        $addons->each(fn($item) => Addon::create([
            'name'  => $item[0],
            'price' => $item[1],
        ]));
    }
}
