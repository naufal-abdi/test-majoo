<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShopController::class, 'index']);



Route::get('/shop', [ShopController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'check']);    


Route::prefix('/admin')->middleware('auth:admin')->group( function() {
    Route::get('/', [DashboardController::class, 'index']);

    Route::prefix('/produk')->group(function() {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('/add', [ProductController::class, 'add']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::get('/del/{id}', [ProductController::class, 'delete']);
    });

    Route::prefix('/kategori')->group(function() {
        Route::get('/', [ProductCategoryController::class, 'index']);
        Route::get('/add', [ProductCategoryController::class, 'add']);
        Route::post('/', [ProductCategoryController::class, 'store']);
        Route::get('/{id}', [ProductCategoryController::class, 'show']);
        Route::get('/del/{id}', [ProductCategoryController::class, 'delete']);
    });

    Route::prefix('/image')->group(function() {
        Route::post('/', [ImageController::class, 'store']);
        Route::delete('/', [ImageController::class, 'delete']);
    });

    Route::get('/logout', [AuthController::class, 'logout']);
});