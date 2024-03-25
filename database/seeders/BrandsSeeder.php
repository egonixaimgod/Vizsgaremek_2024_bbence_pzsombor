<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brands;

class BrandsSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            ['name' => 'Intel'],
            ['name' => 'Amd'],
            ['name' => 'G.Skill'],
            ['name' => 'Gigabyte'],
            ['name' => 'MSI'],
        ];

        foreach ($brands as $brandData) {
            Brands::create($brandData);
        }
    }
}