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


//authenticált végpontok

//admin végpontok
//brands
Route::post('/brands', [BrandsController::class, 'store']);
Route::put('/brands/{id}', [BrandsController::class, 'update']);
Route::delete('/brands/{id}', [BrandsController::class, 'destroy']);
//categories
Route::post('/categories', [CategoriesController::class, 'store']);
Route::put('/categories/{id}', [CategoriesController::class, 'update']);
Route::delete('/categories/{id}', [CategoriesController::class, 'destroy']);
//products
Route::post('/products', [ProductsController::class, 'store']);
Route::put('/products/{id}', [ProductsController::class, 'update']);
Route::delete('/products/{id}', [ProductsController::class, 'destroy']);
//order_items
Route::get('/order_items', [OrderItemsController::class, 'index']);
//orders


//user végpontok
//
Route::middleware('auth:sanctum')->group(function () {
    Route::post("/auth/logout", [AuthController::class, "logout"]);
    Route::get('/auth/user',[AuthController::class, 'user']);
});
//order_items
Route::post('/order_items', [OrderItemsController::class, 'store']);
Route::get('/order_items/{id}', [OrderItemsController::class, 'show']);
Route::put('/order_items/{id}', [OrderItemsController::class, 'update']);
Route::delete('/order_items/{id}', [OrderItemsController::class, 'destroy']);
//orders
Route::get('/orders', [OrdersController::class, 'index']);
Route::post('/orders', [OrdersController::class, 'store']);
Route::get('/orders/{id}', [OrdersController::class, 'show']);
Route::put('/orders/{id}', [OrdersController::class, 'update']);
Route::delete('/orders/{id}', [OrdersController::class, 'destroy']);

//auth nélküli végpontok
//auth
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

//brands
Route::get('/brands', [BrandsController::class, 'index']);
Route::get('/brands/{id}', [BrandsController::class, 'show']);

//categories
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/categories/{id}', [CategoriesController::class, 'show']);

//payment
Route::get('/payment', [PaymentController::class, 'index']);
Route::get('/payment/{id}', [PaymentController::class, 'show']);

//products
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/{id}', [ProductsController::class, 'show']);

//customer
/*
Route::get('/users', [CustomerController::class, 'index']);
Route::post('/users', [CustomerController::class, 'store']);
Route::get('/users/{id}', [CustomerController::class, 'show']);
Route::put('/users/{id}', [CustomerController::class, 'update']);
Route::delete('/users/{id}', [CustomerController::class, 'destroy']);
*/
