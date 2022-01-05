<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\ManpowerController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LeasingController;

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
    return view('dashboard');
})->name('dashboard');

// DEALER
Route::middleware(['auth:sanctum', 'verified'])->get('/dealer', [DealerController::class, 'index'])->name('dealer');
Route::middleware(['auth:sanctum', 'verified'])->post('/dealer/store', [DealerController::class, 'store'])->name('dealer.store');
Route::middleware(['auth:sanctum', 'verified'])->get('/dealer/edit/{id}', [DealerController::class, 'edit'])->name('dealer.edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/dealer/update', [DealerController::class, 'update'])->name('dealer.update');
Route::middleware(['auth:sanctum', 'verified'])->get('/dealer/delete/{id}', [DealerController::class, 'delete'])->name('dealer.delete');
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