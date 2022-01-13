<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\ManpowerController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LeasingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\OutController;
use App\Http\Controllers\OpnameController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleDeliveryController;
use App\Http\Controllers\BranchDeliveryController;

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

// USER
Route::middleware(['auth:sanctum', 'verified'])->resource('user', UserController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/user/deleteall', [UserController::class, 'deleteall'])->name('user.deleteall');
// END USER

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
Route::middleware(['auth:sanctum', 'verified'])->get('/sale-history/{date?}', [SaleController::class, 'history'])->name('sale.history');
// END SALE

// ENTRY
Route::middleware(['auth:sanctum', 'verified'])->resource('entry', EntryController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/entry/delete/{id}', [EntryController::class, 'delete'])->name('entry.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/entry/deleteall', [EntryController::class, 'deleteall'])->name('entry.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/entry-history/{date?}', [EntryController::class, 'history'])->name('entry.history');
// END ENTRY

// OUT
Route::middleware(['auth:sanctum', 'verified'])->resource('out', OutController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/out/delete/{id}', [OutController::class, 'delete'])->name('out.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/out/deleteall', [OutController::class, 'deleteall'])->name('out.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/out-history/{date?}', [OutController::class, 'history'])->name('out.history');
// END OUT

// HISTORY
Route::middleware(['auth:sanctum', 'verified'])->post('/stock/ratio', [StockController::class, 'ratio'])->name('stock.ratio');
// END HISTORY

// OPNAME
Route::middleware(['auth:sanctum', 'verified'])->resource('opname', OpnameController::class);
Route::middleware(['auth:sanctum', 'verified'])->post('/opname/history', [OpnameController::class, 'history'])->name('opname.history');
// END OPNAME

// REPORT
Route::middleware(['auth:sanctum', 'verified'])->get('/report/stock-history', [ReportController::class, 'stockHistory'])->name('report.stock-history');
Route::middleware(['auth:sanctum', 'verified'])->get('/report/change/{id}/{status}', [ReportController::class, 'changeStatusStockHistory'])->name('report.update-status');
Route::middleware(['auth:sanctum', 'verified'])->post('/report/print/{start?}/{end?}', [ReportController::class, 'print'])->name('report.print');
// END REPORT

// LOG
Route::middleware(['auth:sanctum', 'verified'])->resource('log', LogController::class);
Route::middleware(['auth:sanctum', 'verified'])->post('/log/deleteall', [LogController::class, 'deleteall'])->name('log.deleteall');
// END LOG

// DOKUMEN
Route::middleware(['auth:sanctum', 'verified'])->resource('document', DokumenController::class);
// END DOKUMEN

// SALE DELIVERY
Route::middleware(['auth:sanctum', 'verified'])->resource('sale-delivery', SaleDeliveryController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/sale-delivery/delete/{id}', [SaleDeliveryController::class, 'delete'])->name('sale-delivery.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/sale-delivery/deleteall', [SaleDeliveryController::class, 'deleteall'])->name('sale-delivery.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/sale-delivery-history/{date?}', [SaleDeliveryController::class, 'history'])->name('sale-delivery.history');
// END SALE DELIVERY

// BRANCH DELIVERY
Route::middleware(['auth:sanctum', 'verified'])->resource('branch-delivery', BranchDeliveryController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/branch-delivery/delete/{id}', [BranchDeliveryController::class, 'delete'])->name('branch-delivery.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('/branch-delivery/deleteall', [BranchDeliveryController::class, 'deleteall'])->name('branch-delivery.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/branch-delivery-history/{date?}', [BranchDeliveryController::class, 'history'])->name('branch-delivery.history');
// END BRANCH DELIVERY

// USER
Route::middleware(['auth:sanctum', 'verified'])->resource('user', UserController::class);
Route::middleware(['auth:sanctum', 'verified'])->post('/user/deleteall', [UserController::class, 'deleteall'])->name('user.deleteall');
Route::middleware(['auth:sanctum', 'verified'])->get('/user/change/{id}/{status}', [UserController::class, 'changeStatus'])->name('user.update-status');
// END USER
