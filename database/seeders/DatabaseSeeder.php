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
        \App\Models\Customer::factory()->create([
            'name' => 'admin',
            'email' => '',
            'password' => 'admin',
            'address' => '',
            'county' => '',
            'city' => '',
            'postal_code' => 0,
            'phone' => '',
            'admin' => 'true'
        ]);

   $this->call([
       CustomerSeeder::class,
       OrdersSeeder::class,
       OrderItemsSeeder::class,
       BrandsSeeder::class,
   ]);
    }
}
