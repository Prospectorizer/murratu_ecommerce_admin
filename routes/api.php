<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Master\MasterController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\OrderController;

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

Route::post('/login',[AuthController::class, 'Login']);
Route::post('/register',[AuthController::class, 'Register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/master',[MasterController::class, 'apiList']);
    Route::post('/logout',[AuthController::class, 'Logout']);
    Route::post('/payment-details',[PaymentController::class, 'getPaymentDetails']);
    Route::post('/make-order',[OrderController::class, 'makeOrder']);
    Route::post('/list-order',[OrderController::class, 'list']);
    Route::post('/add-to-cart',[CartController::class, 'add']);
    Route::post('/list-cart',[CartController::class, 'list']);
});
Route::post('/home',[HomeController::class, 'HomeData']);
Route::post('/search',[SearchController::class, 'list']);
Route::post('/product',[ProductController::class, 'view']);
