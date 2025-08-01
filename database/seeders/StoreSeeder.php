<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\Bank;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bank = Bank::first(); // Pick first available bank

        Store::create([
            'name' => 'Al Ahlia Coffee Truck',
            'bank_id' => $bank->id,
            'nfc_tag' => 'nfc001-ahlia',
            'contact_email' => 'contact@ahlia.com',
            'contact_phone' => '0551234567',
            'location' => 'Riyadh Boulevard',
        ]);
    }
}
