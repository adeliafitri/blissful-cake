<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\TestimoniController;
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

Route::middleware(['guest'])->group(function() {
    Route::get('/', [HomeController::class, 'index']);
    Route::post('/testimoni/store', [TestimoniController::class, 'store'])->name('testimoni.store');
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);
});


    Route::get('/register', function () {
        return view('pages.register');
    })->name('register');
    // Route::post('/register', [UserController::class, 'register']);

    Route::get('/home', function () {
        return redirect('/dashboard');
    });

    Route::middleware(['auth'])->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/product-categories', [CategoryController::class, 'index'])->name('productCategories');
        Route::get('/product-categories/add', [CategoryController::class, 'create'])->name('productCategories.create');
        // Route::get('/productCategories/create', [CategoryCon troller::class, 'getCategories'])->name('productCategories.create');
        Route::post('/product-categories', [CategoryController::class, 'store'])->name('productCategories.store');
        Route::get('/product-categories/{id}/edit', [CategoryController::class, 'edit'])->name('productCategories.edit');
        Route::put('/product-categories/{id}', [CategoryController::class, 'update'])->name('productCategories.update');
        Route::delete('/product-categories/{id}', [CategoryController::class, 'destroy'])->name('productCategories.delete');

        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::get('/products/add', [ProductController::class, 'create'])->name('products.create');
        // Route::get('/products/create', [CategoryCon troller::class, 'getCategories'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.delete');

        Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

        Route::middleware(['userAkses:superadmin'])->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users');
            Route::get('/users/add', [UserController::class, 'create'])->name('users.create');
            // Route::get('/users/create', [CategoryCon troller::class, 'getCategories'])->name('users.create');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

            Route::get('/testimonials', [TestimoniController::class, 'index'])->name('testimoni');
        });
        // Logout
        Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
    });

