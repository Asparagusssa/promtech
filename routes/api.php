<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [SessionController::class, 'login']);

Route::apiResource('/products', ProductController::class)->only(['index', 'show']);
Route::apiResource('/categories', CategoryController::class)->only(['index', 'show']);

Route::group(['middleware' => "auth:sanctum"], function () {
    Route::post('/logout', [SessionController::class, 'logout']);
    Route::apiResource('/products', ProductController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('/categories', CategoryController::class)->only(['store', 'update', 'destroy']);
});
