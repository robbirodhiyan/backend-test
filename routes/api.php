<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

// Rute untuk otentikasi (register, login, logout)
Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('logout', [AuthController::class,'logout']);
Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);

    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::post('/transactions', [TransactionController::class, 'store']); // Ganti 'middleware_name' dengan middleware yang sesuai
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::get('/transactions/{id}', [TransactionController::class, 'show']);

// // Rute yang memerlukan otentikasi
// Route::middleware('jwt.verify')->group(function () {
//     Route::get('/user', function (Request $request) {
//         return $request->user();
//     });

//     Route::get('/products', [ProductController::class, 'index']);
//     Route::get('/products/{id}', [ProductController::class, 'show']);

//     Route::post('/products', [ProductController::class, 'store'])->middleware('1');
//     Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('1');
//     Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('1');

//     Route::post('/transactions', [TransactionController::class, 'store'])->middleware('1'); // Ganti 'middleware_name' dengan middleware yang sesuai
//     Route::get('/transactions', [TransactionController::class, 'index'])->middleware('1');
//     Route::get('/transactions/{id}', [TransactionController::class, 'show']);
// });
