<?php

use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use App\Http\Controllers\Api\MediaController as ApiMediaController;
use App\Http\Controllers\Api\NewsController as ApiNewsController;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/media', ApiMediaController::class)->only('index');
Route::apiResource('/category', ApiCategoryController::class)->only('index');
Route::get('/news-home', [ApiNewsController::class, 'home'])->name('news.home');
Route::get('/news', [ApiNewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [ApiNewsController::class, 'show'])->name('news.show');
route::get('/news-search', [ApiNewsController::class, 'search'])->name('news.search');
route::get('/news-another/{id}', [ApiNewsController::class, 'another'])->name('news.another');
route::get('/product-home', [ApiProductController::class, 'home'])->name('product.home');
Route::get('/product', [ApiProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ApiProductController::class, 'show'])->name('product.show');
Route::get('/product-search', [ApiProductController::class, 'search'])->name('product.search');
Route::get('/product-another/{id}', [ApiProductController::class, 'another'])->name('product.another');
Route::get('/product-recommend', [ApiProductController::class, 'recommend'])->name('product.recommend');