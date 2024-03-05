<?php

namespace Database\Factories;

use App\Models\Products;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItems>
 */
class OrderItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->numberBetween(1,10),
            'product_id' => $this->faker->numberBetween(1,6),
            'amount' => $this->faker->numberBetween(1,5)
        ];
    }
}
