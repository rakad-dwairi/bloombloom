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

Route::group(['middleware' => ['api'],'prefix' => 'auth'], function ($router) {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
});

Route::middleware(['auth:api', 'admin'])->group(function () {

    // Frames CRUD

    Route::post('frames', [App\Http\Controllers\API\Admin\FramesController::class, 'store']);
    Route::put('frames/{id}', [App\Http\Controllers\API\Admin\FramesController::class, 'update']);
    Route::delete('frames/{id}', [App\Http\Controllers\API\Admin\FramesController::class, 'destroy']);

    //  Lenses CRUD

    Route::post('lens', [App\Http\Controllers\API\Admin\LensesController::class, 'store']);
    Route::put('lens/{id}', [App\Http\Controllers\API\Admin\LensesController::class, 'update']);
    Route::delete('lens/{id}', [App\Http\Controllers\API\Admin\LensesController::class, 'destroy']);

});

Route::middleware('auth:api')->group(function () {
    Route::get('frames/active', [App\Http\Controllers\API\User\FramesController::class, 'getActiveFrames']);

    Route::get('lense/active', [App\Http\Controllers\API\User\LensesController::class, 'getActiveLenses']);

    Route::get('orders/create', [App\Http\Controllers\API\User\OrdersController::class, 'createCustomGlasses']);

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
