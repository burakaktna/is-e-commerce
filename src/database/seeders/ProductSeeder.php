<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = json_decode(file_get_contents(database_path('seeds/json/products.json')), true);

        foreach ($products as $product) {
            Product::create([
                'id' => $product['id'],
                'name' => $product['name'],
                'category' => $product['category'],
                'price' => $product['price'],
                'stock' => $product['stock'],
            ]);
        }
    }
}
