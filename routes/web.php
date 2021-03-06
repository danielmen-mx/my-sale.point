<?php

use App\Http\Controllers\Backend\CostumerController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Backend\SalePointController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;

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

Route::get('products/all-products', [ProductController::class, 'productList']);

Route::resource('sale_point', SalePointController::class);


Route::resource('sales', SaleController::class)
    ->middleware('auth');

Route::get('sales/{sale}/linkCostumer', [SaleController::class, 'linkCostumer']);

Route::post('sales/{sale}/linkCostumer', [SaleController::class, 'linkCostToSale']);

Route::get('costumers/get-costumers', [CostumerController::class, 'costumerList']);

Route::resource('costumers', CostumerController::class)
->middleware('auth');

Route::view('profile', 'profile');

// Route::post('profile', function (\Illuminate\Http\Request $request) {   // Está era la ruote que teniamos para cargar una imagen, definiamos el metodo directamente, pero ahora se refactorizará.
//     $file = $request->file('photo');
//     $file?->store('profiles');
//     return redirect('profile');
// });

Route::post('profile', [App\Http\Controllers\ProfileController::class, 'upload']); // Misma función pero refactorizado.