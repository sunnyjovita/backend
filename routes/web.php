<?php

use App\Http\Controllers\ProductController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// get product
Route::get('/', [ProductController::class, 'getProduct'])->name('get');
// Route::post('/', [ProductController::class, 'addProduct'])->name('post');

// get each product
// Route::get('product/{id}', [ProductController::class, 'getDetail']);

// update product
// Route::post('product/{id}', [ProductController::class, 'updateProduct']);

// delete product
// Route::delete('product/{id}', [ProductController::class, 'deleteProduct']);

