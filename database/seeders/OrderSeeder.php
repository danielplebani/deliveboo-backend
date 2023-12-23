<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Faker\Factory as FakerIt;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $fakerIt = FakerIt::create('it_IT');

        //We will create a year span to place orders in a random date of the year
        $currentYear = Carbon::now()->year;

        $startYear = Carbon::create($currentYear, 1, 1, 0, 0, 0);
        $endYear = Carbon::create($currentYear, 12, 31, 23, 59, 59);

        $seconds = $endYear->diffInSeconds($startYear);

        $restaurants = Restaurant::all()->count();

        for ($i = 0; $i < 500; $i++) {
            $timestamp = $startYear->timestamp + rand(0, $seconds);

            $new_order = new Order();
            $new_order->restaurant_id = rand(1, $restaurants);
            $new_order->total = $faker->randomFloat(2, 1.0, 100);
            $new_order->user_mail = $faker->email();
            $new_order->username = $fakerIt->name();
            $new_order->address = $fakerIt->streetAddress();
            $new_order->phone = $fakerIt->phoneNumber();
            if (rand(1, 100) <= 50) {
                $new_order->notes = '';
            } else {
                $new_order->notes = $fakerIt->sentence();
            }
            $new_order->created_at = Carbon::createFromTimestamp($timestamp);
            $new_order->save();
        }
    }
}
