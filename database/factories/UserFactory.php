<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        $email = $this->faker->email();
        $password = Str::random(10);
        $address = Str::random(10);
        $city = $this->faker->randomElement(['Kecskemét', 'Pécs', 'Békéscsaba', 'Miskolc', 'Szeged', 'Székesfehérvár', 'Győr', 'Debrecen', 'Eger', 'Szolnok', 'Tatabánya', 'Salgótarján', 'Budapest', 'Kaposvár', 'Nyíregyháza', 'Szekszárd', 'Szombathely', 'Veszprém', 'Zalaegerszeg']);
        $postal_code = $this->faker->numberBetween(1000, 9999);
        $phone = Str::random(10);


        return [
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'address' => $address,
            'city' => $city,
            'postal_code' => $postal_code,
            'phone' => $phone,
            'admin' => false,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
