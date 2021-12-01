<?php

use App\Http\Controllers\Backend\CostumerController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Backend\SalePointController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::get('/', [PageController::class, 'posts']);

Route::get('blog/{post}', [PageController::class, 'post'])->name('post');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class)
    ->middleware('auth')
    ->except('show');

Route::resource('products', ProductController::class)
    ->middleware('auth')
    ->except('show');

Route::resource('sale_point', SalePointController::class);

Route::get('products/all-products', [ProductController::class, 'productList']);

Route::resource('sales', SaleController::class)
    ->middleware('auth');

Route::resource('costumers', CostumerController::class)
    ->middleware('auth');