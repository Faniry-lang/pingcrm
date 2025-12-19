<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CategoriesController::class, 'index'])->name('categories.index');
Route::resource('categories', CategoriesController::class)->except(['show']);
Route::resource('products', ProductsController::class);
