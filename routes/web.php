<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\ManpowerController;

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
Route::middleware(['auth:sanctum', 'verified'])->get('/dealer/show/{id}', [DealerController::class, 'show'])->name('dealer.show');
Route::middleware(['auth:sanctum', 'verified'])->post('/dealer/edit', [DealerController::class, 'edit'])->name('dealer.edit');
Route::middleware(['auth:sanctum', 'verified'])->get('/dealer/delete/{id}', [DealerController::class, 'delete'])->name('dealer.delete');
// END DEALER

// MANPOWER
Route::middleware(['auth:sanctum', 'verified'])->resource('manpower', ManpowerController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/manpower/delete/{id}', [DealerController::class, 'delete'])->name('manpower.delete');
// END MANPOWER