<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('data')->name('data.')->group(function () {
        Route::get('download', [DataController::class, 'download'])->name('download');
        Route::get('email', [DataController::class, 'email'])->name('email');
        Route::get('backup', [DataController::class, 'backup'])->name('backup');
    });

    Route::resource('customer', CustomerController::class);
    Route::resource('invoice', InvoiceController::class);
    Route::get('invoice/{invoice}/print', [InvoiceController::class, 'print'])->name('invoice.print');
    Route::get('customer/{customer}/invoices', [CustomerController::class, 'invoices'])->name('customer.invoices');
});
