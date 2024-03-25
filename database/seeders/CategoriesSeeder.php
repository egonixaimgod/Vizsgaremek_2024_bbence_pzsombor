<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Processor'],
            ['name' => 'Memory'],
            ['name' => 'Motherboard'],
        ];

        foreach ($categories as $categoryData) {
            Categories::create($categoryData);
        }
    }
}
