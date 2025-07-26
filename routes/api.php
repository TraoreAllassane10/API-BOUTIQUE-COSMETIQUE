<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\ManageByAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');



Route::middleware('auth:sanctum')->group(function () {
    
    Route::middleware("manager")->group(function () {
        // Routes categorie
        Route::get('/categories', [CategoryController::class, "index"])->name('categories');
        Route::get('/categories/{category}', [CategoryController::class, "show"])->name('categories.show');
        Route::post('/categories', [CategoryController::class, "store"])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, "update"])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, "delete"])->name('categories.delete');

        //Routes Produits
        Route::controller(ProductController::class)->group(function () {
            Route::get('/products', 'index')->name('products');
            Route::get('/products/{product}', 'show')->name('products.show');
            Route::post('/products', 'store')->name('products.store');
            Route::put('/products/{product}',  "update")->name('products.update');
            Route::delete('/products/{product}', "delete")->name('products.delete');
        });
    });


    // Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
