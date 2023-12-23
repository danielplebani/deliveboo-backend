<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::all();
        return view("admin.restaurants.show", compact("dishes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Restaurant $restaurant)
    {
        $dishes = Dish::where('restaurant_id', $restaurant->id)->first();

        return view("admin.restaurants.dishes.create", ['dishes' => $dishes, 'restaurant' => $restaurant]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request, Restaurant $restaurant)
    {
        $validated = $request->validated();

        if ($request->has('image')) {
            $file_path = Storage::put('placeholders', $request->image);
            $validated['image'] = $file_path;
        }

        $validated['slug'] =  Dish::generateSlug($validated['name']);

        Dish::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $validated['image'],
            'available' => $validated['available'],
            'course' => $validated['course'],
            'ingredients' => $validated['ingredients'],
            'restaurant_id' => $restaurant->id,
            'slug' => Str::slug($validated['name']),
        ]);

        return to_route("admin.restaurants.show", $restaurant->slug)->with('message', 'Piatto creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant, Dish $dish)
    {
        return view('admin.restaurants.dishes.show', ['restaurant' => $restaurant, 'dish' => $dish]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant, Dish $dish)
    {
        return view('admin.restaurants.dishes.edit', ['restaurant' => $restaurant, 'dish' => $dish]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Restaurant $restaurant, UpdateDishRequest $request, Dish $dish)
    {
        $validated = $request->validated();

        if ($request->has('image')) {
            $newImage = $request->image;
            $file_path = Storage::put('placeholders', $newImage);
            if (!is_null($dish->image) && Storage::fileExists($dish->image)) {
                Storage::delete($dish->image);
            }

            $validated['image'] = $file_path;
        }

        if (!Str::is($dish->getOriginal('name'), $request->name)) {
            $validated['slug'] = $dish->generateSlug($request->name);
        }

        $dish->update($validated);


        return to_route('admin.restaurant.dishes.show', ['restaurant' => $restaurant, 'dish' => $dish])->with('message', 'Informazioni aggiornate con successo!');
    }

    public function destroy(Restaurant $restaurant, Dish $dish)
    {

        $dish->orders()->detach();
        $dish->delete();

        return to_route('admin.restaurants.show', ['restaurant' => $restaurant])->with('message', 'Piatto eliminato con successo!');
    }
}
