<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Client\ProductClientController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\ManageByAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::controller(ProductClientController::class)->group(function() {
    Route::get('/products', 'index')->name('products');
    Route::get('/products/{product}', 'show')->name('products.show');
});

Route::middleware('auth:sanctum')->group(function () {
    
    Route::middleware("manager")->group(function () {
        // Routes categorie
        Route::get('/admin/categories', [CategoryController::class, "index"])->name('admin.categories');
        Route::get('/admin/categories/{category}', [CategoryController::class, "show"])->name('admin.categories.show');
        Route::post('/admin/categories', [CategoryController::class, "store"])->name('admin.categories.store');
        Route::put('/admin/categories/{category}', [CategoryController::class, "update"])->name('admin.categories.update');
        Route::delete('/admin/categories/{category}', [CategoryController::class, "delete"])->name('admin.categories.delete');

        //Routes Produits
        Route::controller(ProductController::class)->group(function () {
            Route::get('/admin/products', 'index')->name('admin.products');
            Route::get('/admin/products/{product}', 'show')->name('admin.products.show');
            Route::post('/admin/products', 'store')->name('admin.products.store');
            Route::put('/admin/products/{product}',  "update")->name('admin.products.update');
            Route::delete('/admin/products/{product}', "delete")->name('admin.products.delete');
        });
    });


    // Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
