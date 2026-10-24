<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

// Menampilkan halaman login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// Memproses login
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Products
|--------------------------------------------------------------------------
*/

// Menampilkan semua produk
// Bisa diakses semua orang
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

// Form tambah produk
// Hanya Admin
Route::get('/products/create', [ProductController::class, 'create'])
    ->middleware(['auth', 'can:admin'])
    ->name('products.create');

// Menyimpan produk baru
// Hanya Admin
Route::post('/products', [ProductController::class, 'store'])
    ->middleware(['auth', 'can:admin'])
    ->name('products.store');

// Form edit produk
// Hanya Admin
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
    ->middleware(['auth', 'can:admin'])
    ->name('products.edit');

// Update produk
// Hanya Admin
Route::put('/products/{id}', [ProductController::class, 'update'])
    ->middleware(['auth', 'can:admin'])
    ->name('products.update');

// Hapus produk
// Hanya Admin
Route::delete('/products/{id}', [ProductController::class, 'destroy'])
    ->middleware(['auth', 'can:admin'])
    ->name('products.destroy');

// Detail produk
// Bisa diakses semua orang
Route::get('/products/{id}', [ProductController::class, 'show'])
    ->name('products.show');


/*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/

// Menampilkan semua kategori
// Bisa diakses semua user
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

// Form tambah kategori
// Hanya Admin
Route::get('/categories/create', [CategoryController::class, 'create'])
    ->middleware(['auth', 'can:admin'])
    ->name('categories.create');

// Menyimpan kategori baru
// Hanya Admin
Route::post('/categories', [CategoryController::class, 'store'])
    ->middleware(['auth', 'can:admin'])
    ->name('categories.store');

// Detail kategori
// Bisa diakses semua user
Route::get('/categories/{id}', [CategoryController::class, 'show'])
    ->name('categories.show');

// Form edit kategori
// Hanya Admin
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])
    ->middleware(['auth', 'can:admin'])
    ->name('categories.edit');

// Update kategori
// Hanya Admin
Route::put('/categories/{id}', [CategoryController::class, 'update'])
    ->middleware(['auth', 'can:admin'])
    ->name('categories.update');

// Hapus kategori
// Hanya Admin
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])
    ->middleware(['auth', 'can:admin'])
    ->name('categories.destroy');
/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/

// Menampilkan isi keranjang
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

// Menambahkan produk ke keranjang
Route::post('/cart/add/{id}', [CartController::class, 'add'])
    ->name('cart.add');

// Mengubah jumlah produk di keranjang
Route::put('/cart/update/{id}', [CartController::class, 'update'])
    ->name('cart.update');

// Menghapus produk dari keranjang
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');


/*
|--------------------------------------------------------------------------
| Orders / Checkout
|--------------------------------------------------------------------------
*/

// Menampilkan halaman checkout
Route::get('/checkout', [OrderController::class, 'checkout'])
    ->name('checkout');

// Membuat order baru
Route::post('/checkout', [OrderController::class, 'store'])
    ->name('checkout.store');