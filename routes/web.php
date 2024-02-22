<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MollieController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use Mollie\Laravel\Facades\Mollie;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|voyager
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerStore'])->name('registerStore');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/show/{id}',[ProductController::class,'show'])->name('show');
Route::get('/home',[HomeController::class,'index']);
Route::get('/search',[ProductController::class,'search'])->name('search');
Route::get('/store',[ProductController::class,'store'])->name('store');
Route::get('/',[HomeController::class,'index'])->name('home');

Route::middleware('auth')->group(function () {
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/insert', [CartController::class, 'insert'])->name('cart.insert');
Route::post('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/check', [CartController::class, 'check'])->name('cart.check');
Route::get('/checkout', [MollieController::class, 'mollie'])->name('pay');
Route::get('/succes', [MollieController::class, 'succes'])->name('succes');
Route::get('/order', [OrderController::class, 'index'])->name('order.index');

});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Route::get('/',[ProductController::class,'index'])->name('home');