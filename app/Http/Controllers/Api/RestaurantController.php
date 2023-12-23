<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'results' => Restaurant::with(['dishes', 'types'])->paginate(12),
        ]);
    }

    public function getRestaurantsByTypes(Request $request)
    {
        $typeIds = $request->input('type_ids');

        $typeIdsArray = explode(',', $typeIds);

        // Debugging

        return response()->json([
            'success' => true,
            'results' => Restaurant::whereHas('types', function ($query) use ($typeIdsArray) {
                $query->whereIn('type_id', $typeIdsArray);
            }, '=', count($typeIdsArray))->paginate(12)->withQueryString()
        ]);
    }

    public function show($slug)
    {
        $restaurant = Restaurant::with('dishes', 'types')->where('slug', $slug)->first();
        if ($restaurant) {
            return response()->json([
                'success' => true,
                'result' => $restaurant
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Ops! Page not found'
            ]);
        }
    }
}
