<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\SuggestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\EkskulController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SmartController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonyController;
use App\Http\Controllers\Frontend\EventController as FrontendEventController;
use App\Http\Controllers\Frontend\StoreController as FrontendStoreController;
use App\Http\Controllers\Pelatih\DataSiswaController;
use App\Http\Controllers\Siswa\InfoEkskulController;
use App\Http\Controllers\Siswa\InfoKriteriaController;
use App\Http\Controllers\Siswa\PemilihanEkskulController;
use App\Http\Controllers\Siswa\RiwayatPemilihanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index.home');
// Route::post('/store-suggestion', [HomeController::class, 'storeSuggest'])->name('store.suggestion');

// Route::prefix('front-store')->group(function () {
//     Route::get('/index', [FrontendStoreController::class, 'index'])->name('front.store.index');
//     Route::get('/show/{id}', [FrontendStoreController::class, 'show'])->name('front.store.show');
// });

// Route::prefix('front-event')->group(function () {
//     Route::get('/index', [FrontendEventController::class, 'index'])->name('front.event.index');
//     Route::get('/show/{id}', [FrontendEventController::class, 'show'])->name('front.event.show');
// });


// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('/show', [CategoryController::class, 'index'])->name('category.show');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    Route::prefix('media')->group(function () {
        Route::get('/show', [MediaController::class, 'index'])->name('media.show');
        Route::post('/store', [MediaController::class, 'store'])->name('media.store');
        Route::post('/update/{id}', [MediaController::class, 'update'])->name('media.update');
        Route::get('/destroy/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
    });

    Route::prefix('product')->group(function () {
        Route::get('/show', [ProductController::class, 'index'])->name('product.show');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    Route::prefix('news')->group(function () {
        Route::get('/show', [NewsController::class, 'index'])->name('news.show');
        Route::get('/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/store', [NewsController::class, 'store'])->name('news.store');
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
        Route::post('/update/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::get('/destroy/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    });

    Route::prefix('user')->group(function () {
        Route::get('/show', [UserController::class, 'index'])->name('user.show');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });
});

require __DIR__ . '/auth.php';
