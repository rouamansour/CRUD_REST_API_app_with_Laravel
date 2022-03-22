<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ScategorieController;
use App\Http\Controllers\ArticleController;

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

Route::middleware('api')->group(function () {
    Route::resource('roua/categories', CategorieController::class);
    Route::resource('roua/scategories',ScategorieController::class);
    Route::resource('roua/articles', ArticleController::class);
});

// Route::middleware('api')->group(function () {
//     Route::resource('scategories',ScategorieController::class);
// });

Route::get('/scat/{idcat}',
[ScategorieController::class,'showSCategorieByCAT']);

// Route::middleware('api')->group(function () {
//     Route::resource('articles', ArticleController::class);
// });


