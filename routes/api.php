<?php

use App\Http\Controllers\API\LeadController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('restaurants', [RestaurantController::class, 'index'])->name('api.restaurants');
Route::get('restaurants/types', [RestaurantController::class, 'getRestaurantsByTypes']);
Route::get('restaurants/{restaurant:slug}', [RestaurantController::class, 'show']);

//braintree
Route::get('orders/generate', [OrderController::class, 'generate']);
Route::post('orders/make/payment', [OrderController::class, 'makePayment']);

//order
Route::post('orders/newOrder', [OrderController::class, 'newOrder']);

//filter
Route::get('types', [TypeController::class, 'index'])->name('api.types');
Route::get('types/{type:slug}', [TypeController::class, 'show']);

//mail
Route::post('mail', [LeadController::class, 'store']);
