<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCompanyController;
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminItemController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/category/{id}', [IndexController::class, 'category'])->name('index.category');
Route::get('/search/{name}', [IndexController::class, 'search'])->name('index.search');
Route::get('/register', function () { return view('register'); })->name('auth.register');
Route::post('/register', [RegisterController::class, 'index'])->name('cont.register');

Route::get('/login', function () { return view('login'); })->name('auth.login');
Route::post('/login', [LoginController::class, 'index'])->name('cont.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::get('/user/cities/{id}', [UserController::class, 'getCities'])->name('user.cities');

Route::get('/item/{id}', [ItemController::class, 'index'])->name('item.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'create'])->name('cart.create');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/cart/cities/{id}', [CartController::class, 'getCities'])->name('cart.cities');
Route::get('/cart/shipping/{id}/{weight}', [CartController::class, 'getShipping'])->name('cart.cities');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');

Route::get('/payment', [TransactionController::class, 'payment'])->name('payment.index');
Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transaction/proof/{id}', [TransactionController::class, 'proof'])->name('transaction.proof');
Route::post('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
Route::post('/transaction/update', [TransactionController::class, 'update'])->name('transaction.update');

// admin

Route::group([
        'prefix' => 'admin',
], function () {
    Route::get('/', [AdminIndexController::class, 'index'])->name('admin.index');
    Route::get('/profile', [AdminIndexController::class, 'profile'])->name('admin.profile.index');
    Route::post('/profile/update', [AdminIndexController::class, 'update'])->name('admin.profile.update');

    Route::get('/item', [AdminItemController::class, 'index'])->name('admin.item.index');
    Route::post('/item/create', [AdminItemController::class, 'create'])->name('admin.item.create');
    Route::post('/item/update', [AdminItemController::class, 'update'])->name('admin.item.update');
    Route::get('/item/delete/{id}', [AdminItemController::class, 'destroy'])->name('admin.item.delete');

    Route::get('/category', [AdminCategoryController::class, 'index'])->name('admin.category.index');
    Route::post('/category/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/category/update', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/category/delete/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.category.delete');

    Route::get('/transaction', [AdminTransactionController::class, 'index'])->name('admin.transaction.index');
    Route::post('/transaction/update', [AdminTransactionController::class, 'update'])->name('admin.transaction.update');
    Route::post('/transaction/report', [AdminTransactionController::class, 'report'])->name('admin.transaction.report');
    Route::post('/transaction/export', [AdminTransactionController::class, 'export'])->name('admin.transaction.export');

    Route::get('/user', [AdminUserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/update/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::get('/user/reset/{id}', [AdminUserController::class, 'reset'])->name('admin.user.reset');

    Route::get('/company', [AdminCompanyController::class, 'index'])->name('admin.company.index');
    Route::post('/company/update', [AdminCompanyController::class, 'update'])->name('admin.company.update');
    Route::get('/company/cities/{id}', [AdminCompanyController::class, 'getCities'])->name('admin.company.cities');
});
