<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Admin routes */

/* Route::get('/mailable', function () {
    $lead = App\Models\Lead::find(1);

    return new App\Mail\NewLeadEmailMd($lead);
}); */

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

        Route::resource('/restaurants', RestaurantController::class)->parameters(['restaurants' => 'restaurant:slug']);

        Route::get('/restaurants/{restaurant}/orders', [RestaurantController::class, 'orders'])->name('restaurants.orders');

        Route::get('/restaurants/{restaurant}/orders/{order}', [OrderController::class, 'show'])->name('restaurants.orders.show');


        Route::resource('/restaurants/{restaurant}/dishes', DishController::class)->parameters(['restaurant' => 'restaurant:slug', 'dish' => 'dish:slug'])->names([
            'index' => 'restaurant.dishes.index',
            'create' => 'restaurant.dishes.create',
            'store' => 'restaurant.dishes.store',
            'show' => 'restaurant.dishes.show',
            'edit' => 'restaurant.dishes.edit',
            'update' => 'restaurant.dishes.update',
            'destroy' => 'restaurant.dishes.destroy',
        ]);
    });

/* Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

require __DIR__ . '/auth.php';
