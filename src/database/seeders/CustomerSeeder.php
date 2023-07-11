<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = json_decode(file_get_contents(database_path('seeds/json/customers.json')), true);

        foreach ($customers as $customer) {
            Customer::create([
                'id' => $customer['id'],
                'name' => $customer['name'],
                'since' => $customer['since'],
                'revenue' => $customer['revenue'],
            ]);
        }
    }
}
