<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            ['name' => 'Al Inma Bank', 'iban' => 'SA1000000000000000000001', 'settlement_cycle' => 'daily'],
            ['name' => 'X bank', 'iban' => 'SA1000000000000000000002', 'settlement_cycle' => 'weekly'],
            ['name' => 'y bank', 'iban' => 'SA1000000000000000000003', 'settlement_cycle' => 'monthly'],
        ];

        foreach ($banks as $bank) {
            Bank::updateOrCreate(['iban' => $bank['iban']], $bank);
        }
    }
}
