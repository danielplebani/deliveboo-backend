<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'results' => Type::all(),
        ]);
    }

    public function show($slug)
    {
        $type = Type::with('restaurants')->where('slug', $slug)->paginate();
        if ($type) {
            return response()->json([
                'success' => true,
                'result' => $type
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Ops! Page not found'
            ]);
        }
    }
}
