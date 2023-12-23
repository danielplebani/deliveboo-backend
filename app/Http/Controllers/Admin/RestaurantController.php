<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Type;
use App\Models\Dish;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $restaurants = Restaurant::where('user_id', Auth::id())->get();

        return view("admin.dashboard", compact("restaurants"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view("admin.restaurants.create", compact("types"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        $validated = $request->validated();

        if ($request->has('image')) {
            $file_path = Storage::put('placeholders', $request->image);
            $validated['image'] = $file_path;
        }

        $validated['slug'] =  Restaurant::generateSlug($validated['name']);

        $restaurant = Restaurant::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'description' => $validated['description'],
            'image' => $validated['image'],
            'user_id' => Auth::id(),
            'slug' => Restaurant::generateSlug($validated['name'])
        ]);

        $restaurant->types()->attach($request->types);

        return to_route("admin.restaurants.index")->with('message', 'Ristorante creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        $dishes = Dish::where('restaurant_id', $restaurant->id)->get();

        return view('admin.restaurants.show', compact('restaurant', 'dishes'));
    }

    public function orders(Restaurant $restaurant)
    {
        $orders = Order::where('restaurant_id', $restaurant->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.restaurants.orders', compact('restaurant', 'orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        $types = Type::all();
        return view('admin.restaurants.edit', compact('restaurant', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        $validated = $request->validated();

        if ($request->has('image')) {
            $newImage = $request->image;
            $file_path = Storage::put('placeholders', $newImage);
            if (!is_null($restaurant->image) && Storage::fileExists($restaurant->image)) {
                Storage::delete($restaurant->image);
            }

            $validated['image'] = $file_path;
        }

        if (!Str::is($restaurant->getOriginal('name'), $request->name)) {
            $validated['slug'] = $restaurant->generateSlug($request->name);
        }

        $restaurant->types()->sync($request->types);
        $restaurant->update($validated);


        return to_route('admin.restaurants.index', $restaurant)->with('message', 'Informazioni aggiornate con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->types()->detach();

        $restaurant->delete();

        return to_route('admin.restaurants.index');
    }
}
