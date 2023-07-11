<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = json_decode(file_get_contents(database_path('seeds/json/orders.json')), true);

        foreach ($orders as $order) {
            Order::create([
                'id' => $order['id'],
                'customer_id' => $order['customerId'],
                'total' => $order['total'],
            ]);
        }
    }
}
