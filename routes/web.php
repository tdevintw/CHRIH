<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
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


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/home',[ProductController::class,'index']);
Route::get('/show/{id}',[ProductController::class,'show'])->name('show');
Route::get('/home',[HomeController::class,'index']);
Route::get('/search',[ProductController::class,'search'])->name('search');
Route::get('/store',[ProductController::class,'store'])->name('store');
Route::get('/',[HomeController::class,'index'])->name('home');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/category/show/{categoryId}', 'ProductController@showProductsByCategory')->name('products.show_by_category');
