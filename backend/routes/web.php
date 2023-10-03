<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DishesController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\OrdersStatisticController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    //creare un controller per reindirizzare la pagina al LOGIN
    return redirect('ur/dashboard');
});


Route::get('/dashboard', function () {
    return view('ur.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])
    ->name('ur.')
    ->prefix('ur')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('dishes', DishesController::class)->parameters([
            'dishes' => 'dishes:id'
        ]);
        Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
        Route::get('/ordersStatistic', [OrdersStatisticController::class, 'index'])->name('ordersStatistic');
        Route::post('/dishes/filter', [DishesController::class, 'filterDishes'])->name('filterdishes');
    });
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
