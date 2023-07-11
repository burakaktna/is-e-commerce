<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orders = json_decode(file_get_contents(database_path('seeds/json/orders.json')), true);

        foreach ($orders as $orderData) {
            $order = Order::find($orderData['id']);

            foreach ($orderData['items'] as $itemData) {
                $orderItem = new OrderItem([
                    'order_id' => $order->id,
                    'product_id' => $itemData['productId'],
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $itemData['unitPrice'],
                    'total' => $itemData['total'],
                ]);

                $orderItem->save();
            }
        }
    }
}
