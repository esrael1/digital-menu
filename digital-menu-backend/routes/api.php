<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import controllers at the top
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PublicMenuController;

Route::get('/public-menu/{slug}', [PublicMenuController::class, 'show']);

// Get authenticated user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Category APIs (authenticated)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
});

// Menu Item APIs (authenticated)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/menu-items', [MenuItemController::class, 'index']);
    Route::post('/menu-items', [MenuItemController::class, 'store']);
    Route::delete('/menu-items/{id}', [MenuItemController::class, 'destroy']);
});
