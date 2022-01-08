<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\ManpowerController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LeasingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('page');
})->name('dashboard');

// DEALER
Route::middleware(['auth:sanctum', 'verified'])->resource('dealer', DealerController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/dealer/delete/{id}', [DealerController::class, 'delete'])->name('dealer.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/dealer/deleteall', [DealerController::class, 'deleteall'])->name('dealer.deleteall');
// END DEALER

// MANPOWER
Route::middleware(['auth:sanctum', 'verified'])->resource('manpower', ManpowerController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/manpower/delete/{id}', [ManpowerController::class, 'delete'])->name('manpower.delete');
// END MANPOWER

// COLOR
Route::middleware(['auth:sanctum', 'verified'])->resource('color', ColorController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/color/delete/{id}', [ColorController::class, 'delete'])->name('color.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/color/deleteall', [ColorController::class, 'deleteall'])->name('color.deleteall');
// END COLOR

// UNIT
Route::middleware(['auth:sanctum', 'verified'])->resource('unit', UnitController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/unit/delete/{id}', [UnitController::class, 'delete'])->name('unit.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/unit/deleteall', [UnitController::class, 'deleteall'])->name('unit.deleteall');
// END UNIT

// LEASING
Route::middleware(['auth:sanctum', 'verified'])->resource('leasing', LeasingController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/leasing/delete/{id}', [LeasingController::class, 'delete'])->name('leasing.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/leasing/deleteall', [LeasingController::class, 'deleteall'])->name('leasing.deleteall');
// END LEASING

// STOCK
Route::middleware(['auth:sanctum', 'verified'])->resource('stock', StockController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/stock/delete/{id}', [StockController::class, 'delete'])->name('stock.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/stock/deleteall', [StockController::class, 'deleteall'])->name('stock.deleteall');
// END STOCK

// SALE
Route::middleware(['auth:sanctum', 'verified'])->resource('sale', SaleController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/sale/delete/{id}', [SaleController::class, 'delete'])->name('sale.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/sale/deleteall', [SaleController::class, 'deleteall'])->name('sale.deleteall');
// END SALE

Route::middleware(['auth:sanctum', 'verified'])->get('/entry', function () {
    return view('page');
})->name('entry.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/out', function () {
    return view('page');
})->name('out.index');