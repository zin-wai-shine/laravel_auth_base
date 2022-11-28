<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function(){

    Route::post("login", [\App\Http\Controllers\AuthApiController::class, "login"])->name("login");
    Route::post("register", [\App\Http\Controllers\AuthApiController::class, "register"])->name("register");

    Route::middleware('auth:sanctum')->group(function (){
        Route::post("logout",[\App\Http\Controllers\AuthApiController::class,"logout"])->name("logout");
        Route::post("logoutAll",[\App\Http\Controllers\AuthApiController::class,"logoutAll"])->name("logoutAll");
        Route::post("logoutAllWithoutCurrentAccess",[\App\Http\Controllers\AuthApiController::class,"logoutAllWithoutCurrentAccess"])->name("logoutAllWithoutCurrentAccess");
        Route::get("tokens",[\App\Http\Controllers\AuthApiController::class,"tokens"])->name("tokens");

        Route::resource("user", \App\Http\Controllers\UserController::class);

        Route::resource('category', \App\Http\Controllers\CategoryController::class);

        Route::resource('sub-category', \App\Http\Controllers\SubCategoryController::class);

        Route::resource('product', \App\Http\Controllers\ProductController::class);

    });
});

