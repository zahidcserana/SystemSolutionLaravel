<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [RegisterController::class, 'login']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('customer', CustomerController::class);
    Route::resource('invoice', InvoiceController::class);

    Route::resource('payment', PaymentController::class);
    Route::post('payment/adjust/{payment}', [PaymentController::class, 'adjust']);

    Route::get('customers', [CustomerController::class, 'list']);
});
