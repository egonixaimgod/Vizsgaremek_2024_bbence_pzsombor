<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['category_id' => 1, 'brand_id' => 1, 'name' => 'i7-11700k', 'cost' => 117000, 'amount' => 0, 'description' => "faszfasz"],
            ['category_id' => 1, 'brand_id' => 2, 'name' => 'Ryzen 5 5600x', 'cost' => 600, 'amount' => 0, 'description' => "faszfasz"],
            ['category_id' => 2, 'brand_id' => 3, 'name' => '16GB DDR4 3200MHz CL16 Trident Z RGB', 'cost' => 25000, 'amount' => 0, 'description' => "faszfasz"],
            ['category_id' => 2, 'brand_id' => 4, 'name' => '16GB DDR4 3733MHz Kit Aorus RGB', 'cost' => 26000, 'amount' => 0, 'description' => "faszfasz"],
            ['category_id' => 3, 'brand_id' => 4, 'name' => 'B550 Gaming X V2', 'cost' => 45000, 'amount' => 0, 'description' => "faszfasz"],
            ['category_id' => 3, 'brand_id' => 5, 'name' => 'MSI MPG Z590 GAMING PLUS', 'cost' => 90000, 'amount' => 0,'description' => "faszfasz"],
        ];

        foreach ($products as $productData) {
            Products::create($productData);
        }
    }
}
