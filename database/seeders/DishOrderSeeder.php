<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = Dish::all();
        $orders = Order::all();

        $dishes->each(function ($dish) use ($orders) {
            $numberOfOrders = rand(1, min(20, $orders->count()));



            $selectedOrders = $orders->shuffle()->take($numberOfOrders);

            if ($numberOfOrders > 0) {
                $existingOrders = $dish->orders()->pluck('id')->toArray();
                $selectedOrders = $selectedOrders->reject(function ($order) use ($existingOrders) {
                    return in_array($order->id, $existingOrders);
                });


                foreach ($selectedOrders as $order) {
                    $qty = rand(1, 5); // Imposta la quantità
                    $dish->orders()->attach([$order->id => ['qty' => $qty]]);
                }
            }
        });
    }
}
