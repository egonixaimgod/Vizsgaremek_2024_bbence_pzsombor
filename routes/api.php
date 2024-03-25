<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderItemsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductsController;

use App\Http\Controllers\Api\AuthController;

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

//register
Route::post('/register', [AuthController::class, 'register']);//szar

//brands
Route::get('/brands', [BrandsController::class, 'index']);
Route::post('/brands', [BrandsController::class, 'store']);
Route::get('/brands/{brand}', [BrandsController::class, 'show']);
Route::put('/brands/{brand}', [BrandsController::class, 'update']);
Route::delete('/brands/{brand}', [BrandsController::class, 'destroy']);

//categories
Route::get('/categories', [CategoriesController::class, 'index']);
Route::post('/categories', [CategoriesController::class, 'store']);
Route::get('/categories/{category}', [CategoriesController::class, 'show']);
Route::put('/categories/{category}', [CategoriesController::class, 'update']);
Route::delete('/categories/{category}', [CategoriesController::class, 'destroy']);

//customer
Route::get('/customer', [CustomerController::class, 'index']);
Route::post('/customer', [CustomerController::class, 'store']);
Route::get('/customer/{customer}', [CustomerController::class, 'show']);
Route::put('/customer/{customer}', [CustomerController::class, 'update']);
Route::delete('/customer/{customer}', [CustomerController::class, 'destroy']);

//order_items
Route::get('/order_items', [OrderItemsController::class, 'index']);
Route::post('/order_items', [OrderItemsController::class, 'store']);
Route::get('/order_items/{order_item}', [OrderItemsController::class, 'show']);
Route::put('/order_items/{order_item}', [OrderItemsController::class, 'update']);
Route::delete('/order_items/{order_item}', [OrderItemsController::class, 'destroy']);

//orders
Route::get('/orders', [OrdersController::class, 'index']);
Route::post('/orders', [OrdersController::class, 'store']);
Route::get('/orders/{order}', [OrdersController::class, 'show']);
Route::put('/orders/{order}', [OrdersController::class, 'update']);
Route::delete('/orders/{order}', [OrdersController::class, 'destroy']);

//payment
Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/payment', [PaymentController::class, 'store']);
Route::get('/payment/{payment}', [PaymentController::class, 'show']);
Route::put('/payment/{payment}', [PaymentController::class, 'update']);
Route::delete('/payment/{payment}', [PaymentController::class, 'destroy']);

//products
Route::get('/products', [ProductsController::class, 'index']);
Route::post('/products', [ProductsController::class, 'store']);
Route::get('/products/{product}', [ProductsController::class, 'show']);
Route::put('/products/{product}', [ProductsController::class, 'update']);
Route::delete('/products/{product}', [ProductsController::class, 'destroy']);
