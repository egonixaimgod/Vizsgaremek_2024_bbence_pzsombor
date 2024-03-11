<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderItemsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductsController;

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

//brands
Route::get('/brands', [BrandsController::class, 'index']);

//categories
Route::get('/categories', [CategoriesController::class, 'index']);

//customer
Route::get('/customer', [CustomerController::class, 'index']);

//order_items
Route::get('/order_items', [OrderItemsController::class, 'index']);

//orders
Route::get('/orders', [OrdersController::class, 'index']);

//payment
Route::get('/payment', [PaymentController::class, 'index']);

//products
Route::get('/products', [ProductsController::class, 'index']);
