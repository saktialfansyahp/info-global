<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SubcategoryController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function () {
    Route::resource('barang', BarangController::class);
    Route::resource('product', ProductController::class);
    Route::resource('color', ColorController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubcategoryController::class);
    Route::group([
        'prefix' => 'sort'
    ], function () {
        Route::get('ascending/{by}', [Controller::class, 'sortAsc']);
        Route::get('descending/{by}', [Controller::class, 'sortDesc']);
        Route::get('color/ascending', [Controller::class, 'sortAscColor']);
        Route::get('color/descending', [Controller::class, 'sortDescColor']);
        Route::get('category/ascending/{by}', [Controller::class, 'sortAscCategory']);
        Route::get('category/descending/{by}', [Controller::class, 'sortDescCategory']);
        Route::get('subcategory/ascending/{by}', [Controller::class, 'sortAscSubcategory']);
        Route::get('subcategory/descending/{by}', [Controller::class, 'sortDescSubcategory']);
    });
});

