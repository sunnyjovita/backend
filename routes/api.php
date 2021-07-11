<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// get product
Route::get('product', [ProductController::class, 'getProductServerSide'])->name('api.getProduct');

// get each product
Route::get('product/{id}', [ProductController::class, 'getDetail']);

// post product
Route::post('post/product', [ProductController::class, 'postProduct'])->name('api.postProduct');

// update product

Route::post('update', [ProductController::class, 'updateProduct'])->name('api.updateProduct');

Route::get('edit/{id}', [ProductController::class, 'updateProductServerSide'])->name('api.getById');

// Route::get('delete/{id}', [ProductController::class, 'deleteProduct'])->name('api.deleteById');
// Route::delete('')
 
// delete product
Route::delete('delete/{id}', [ProductController::class, 'deleteProduct'])->name('api.deleteProduct');
