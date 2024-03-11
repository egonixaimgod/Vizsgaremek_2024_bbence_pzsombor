<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
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
        $county = $this->faker->randomElement(['Kecskemét', 'Pécs', 'Békéscsaba', 'Miskolc', 'Szeged', 'Székesfehérvár', 'Győr', 'Debrecen', 'Eger', 'Szolnok', 'Tatabánya', 'Salgótarján', 'Budapest', 'Kaposvár', 'Nyíregyháza', 'Szekszárd', 'Szombathely', 'Veszprém', 'Zalaegerszeg']);
        $city = $this->faker->randomElement(['Bács-Kiskun', 'Baranya', 'Békés', 'Borsod-Abaúj-Zemplén', 'Csongrád-Csanád', 'Fejér', 'Győr-Moson-Sopron', 'Hajdú-Bihar', 'Heves', 'Jász-Nagykun-Szolnok', 'Komárom-Esztergom', 'Nógrád', 'Pest', 'Somogy', 'Szabolcs-Szatmár-Beger', 'Tolna', 'Vas', 'Veszprém', 'Zala']);
        $postal_code = $this->faker->numberBetween(1000, 9999);
        $phone = Str::random(10);

        return [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'address' => $address,
            'county' => $county,
            'city' => $city,
            'postal_code' => $postal_code,
            'phone' => $phone,
            'admin' => 'false'
        ];
    }
}
