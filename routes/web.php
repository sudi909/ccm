<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
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
Route::get('/register', function () { return view('register'); })->name('auth.register');
Route::post('/register', [RegisterController::class, 'index'])->name('cont.register');

Route::get('/login', function () { return view('login'); })->name('auth.login');
Route::post('/login', [LoginController::class, 'index'])->name('cont.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::get('/item/{id}', [ItemController::class, 'index'])->name('item.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'create'])->name('cart.create');
Route::post('/cart/edit', [CartController::class, 'edit'])->name('cart.update');
Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.destroy');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');

Route::get('/payment', [TransactionController::class, 'payment'])->name('payment.index');
Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transaction/{id}/proof', [TransactionController::class, 'proof'])->name('transaction.proof');
Route::post('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
Route::post('/transaction/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
