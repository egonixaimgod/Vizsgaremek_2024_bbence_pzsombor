<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $payments = [
            ['status' => 'boltban'],
            ['status' => 'háznál'],
        ];

        foreach ($payments as $paymentData) {
            Payment::create($paymentData);
        }
    }
}