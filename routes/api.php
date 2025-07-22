<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');

// Routes categorie
Route::get('/categories', [CategoryController::class, "index"])->name('categories');
Route::get('/categories/{category}', [CategoryController::class, "show"])->name('categories.show');
Route::post('/categories', [CategoryController::class, "store"])->name('categories.store');
Route::put('/categories/{category}', [CategoryController::class, "update"])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, "delete"])->name('categories.delete');

Route::middleware('auth:sanctum')->group(function(){
    // Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
