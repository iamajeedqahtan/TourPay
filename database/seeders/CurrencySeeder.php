<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        $currencies = [
            [
                'name' => 'US Dollar',
                'code' => 'USD',
                'rate_to_sar' => 3.75,
                'fixed_fee' => 2.00,
                'percentage_fee' => 2.5,
            ],
            [
                'name' => 'Euro',
                'code' => 'EUR',
                'rate_to_sar' => 4.10,
                'fixed_fee' => 2.00,
                'percentage_fee' => 2.5,
            ],
            [
                'name' => 'British Pound',
                'code' => 'GBP',
                'rate_to_sar' => 4.85,
                'fixed_fee' => 2.00,
                'percentage_fee' => 2.5,
            ],
            [
                'name' => 'Emirati Dirham',
                'code' => 'AED',
                'rate_to_sar' => 1.02,
                'fixed_fee' => 1.50,
                'percentage_fee' => 2.0,
            ],
            [
                'name' => 'Egyptian Pound',
                'code' => 'EGP',
                'rate_to_sar' => 0.25,
                'fixed_fee' => 1.00,
                'percentage_fee' => 3.0,
            ],
            [
                'name' => 'Indian Rupee',
                'code' => 'INR',
                'rate_to_sar' => 0.045,
                'fixed_fee' => 1.00,
                'percentage_fee' => 3.0,
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::updateOrCreate(
                ['code' => $currency['code']],
                $currency
            );
        }
    }
}
