<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{

    public function run()
    {
        $users = User::all()->count();

        $restaurants = config("restaurants");

        foreach ($restaurants as $restaurant) {
            $new_restaurant = new Restaurant();
            $new_restaurant->name = $restaurant['name'];
            $new_restaurant->user_id = rand(1, $users);
            $new_restaurant->slug = Str::slug($new_restaurant->name, '-');
            $new_restaurant->address = $restaurant['address'];
            $new_restaurant->description = $restaurant['description'];

            $image = file_get_contents('https://source.unsplash.com/600x400/?restaurant');
            $imageName = 'restaurant_' . time() . '.jpg';
            Storage::put('placeholders/' . $imageName, $image);

            $new_restaurant->image = 'placeholders/' . $imageName;
            $new_restaurant->save();
        }
    }
}
