<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
               // Añadir 10 productos
        Product::factory()->count(10)->create();

        // Añadir 20 orders con lines
        Order::factory()->count(20)->create()->each(function ($order) {
            $products = Product::inRandomOrder()->limit(rand(1, 5))->get();
            foreach ($products as $product) {
                OrderLine::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => rand(1, 10),
                ]);
            }
        });
    }
}
