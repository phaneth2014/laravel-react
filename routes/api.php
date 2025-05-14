<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Models\User;

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::post('/category/post',[CategoryController::class, 'store']);
    Route::get('/categories',[CategoryController::class, 'index']);

	Route::get('/items',[ItemController::class, 'getitems']);
	Route::post('/items',[ItemController::class, 'store_item']);
	Route::get('/items/item',[ItemController::class, 'pick_item']);

	Route::get('/user', function (Request $request) {
        return User::all();
    });
});

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

// Route::get('/user', function (Request $request) {
//     return User::all();
// })->middleware('auth:sanctum');
