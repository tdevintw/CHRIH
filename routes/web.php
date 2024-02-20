<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/home',[ProductController::class,'index']);