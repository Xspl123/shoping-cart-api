<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
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




Route::post('/register', [UserController::class,'create']);
Route::post('/login', [UserController::class,'login']);


Route::middleware(['auth:sanctum'])->group(function () {

    // Route to add a product to the cart
    Route::post('/cart/add', [CartController::class, 'addToCart']);

    // Route to retrieve cart contents
    Route::get('/cart', 'CartController@getCart');
});

