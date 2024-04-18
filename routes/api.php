<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderItemsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
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
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
   
    //brands kezelés
    Route::post('/addBrand', [BrandsController::class, 'store']);
    Route::put('/updateBrand/{id}', [BrandsController::class, 'update']);
    Route::delete('/deleteBrand/{id}', [BrandsController::class, 'destroy']);
    //categories
    Route::post('/addCategory', [CategoriesController::class, 'store']);
    Route::put('/updateCategory/{id}', [CategoriesController::class, 'update']);
    Route::delete('/deleteCategory/{id}', [CategoriesController::class, 'destroy']);
    //products
    Route::post('/products', [ProductsController::class, 'store']);
    Route::put('/products/{id}', [ProductsController::class, 'update']);
    Route::delete('/products/{id}', [ProductsController::class, 'destroy']);
    //order_items
    Route::get('/order_items', [OrderItemsController::class, 'index']);
    //orders
    Route::get('/orders', [OrdersController::class, 'index']);
    //users
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/{id}', [UsersController::class, 'show']);
    Route::put('/updateUser/{id}', [UsersController::class, 'update']);
    Route::delete('/deleteUser/{id}', [UsersController::class, 'destroy']);

});


//user végpontok
//
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, "logout"]);
    Route::get('/auth/profile',[AuthController::class, 'profile']);
    Route::delete('/auth/deleteProfile', [AuthController::class, 'deleteProfile']);
    Route::put('/auth/updateProfile', [AuthController::class, 'updateProfile']);
    //Rendelések kezelése
    Route::post('/placeOrder', [OrdersController::class, 'placeOrder']);
    Route::get('/showOrders', [OrdersController::class, 'showOrders']);
    Route::get('/showOrderItems/{id}', [OrderItemsController::class, 'showOrderItems']);
    Route::put('/updateOrder/{id}', [OrdersController::class, 'updateOrder']);
    Route::delete('/deleteOrder/{id}', [OrdersController::class, 'deleteOrder']);
    //order_items
    Route::post('/order_items', [OrderItemsController::class, 'store']);
    Route::get('/order_items/{id}', [OrderItemsController::class, 'show']);
    Route::put('/order_items/{id}', [OrderItemsController::class, 'update']);
    Route::delete('/order_items/{id}', [OrderItemsController::class, 'destroy']);
    //orders
    Route::post('/orders', [OrdersController::class, 'store']);
    Route::get('/orders/{id}', [OrdersController::class, 'show']);
    Route::put('/orders/{id}', [OrdersController::class, 'update']);
    Route::delete('/orders/{id}', [OrdersController::class, 'destroy']);
    //users
    Route::put('/users/{id}', [UsersController::class, 'update']);
    Route::delete('/users/{id}', [UsersController::class, 'destroy']);
    });


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


