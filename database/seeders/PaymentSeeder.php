<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $payments = [
            ['status' => 'Billed'],
            ['status' => 'Paid'],
        ];

        foreach ($payments as $paymentData) {
            Payment::create($paymentData);
        }
    }
}