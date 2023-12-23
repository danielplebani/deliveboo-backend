<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Type;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prendi tutti i ristoranti e tipi disponibili
        $restaurants = Restaurant::all();
        $types = Type::all();

        // Loop sui ristoranti e collega ciascuno a uno o più tipi casuali
        $restaurants->each(function ($restaurant) use ($types) {
            // Genera un numero casuale di tipi da collegare a ciascun ristorante (3 nel caso sotto)
            $numberOfTypes = rand(1, 3);

            // Prendi un numero casuale di tipi senza ripetizioni
            $selectedTypes = $types->random($numberOfTypes);

            // Collega i tipi selezionati al ristorante
            $restaurant->types()->attach($selectedTypes);
        });
    }
}