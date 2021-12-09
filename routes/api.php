<?php

use App\Http\Controllers\Backend\SaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CostumerController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('sales', [SaleController::class, 'store']);

Route::get('costumers', [CostumerController::class, 'index']);

Route::post('costumers', [CostumerController::class, 'store']);

Route::put('costumers/{costumer}', [CostumerController::class, 'update']);

Route::delete('costumers/{costumer}', [CostumerController::class, 'destroy']);