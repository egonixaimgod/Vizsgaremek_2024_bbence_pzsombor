<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
            'address' => '',
            'city' => '',
            'postal_code' => 0,
            'phone' => '',
            'admin' => true
        ]);

   $this->call([
       //OrdersSeeder::class,
       //OrderItemsSeeder::class,
       BrandsSeeder::class,
       CategoriesSeeder::class,
       PaymentSeeder::class,
       ProductsSeeder::class
   ]);
    }
}
