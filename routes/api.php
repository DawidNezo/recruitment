<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::apiResource('employee', EmployeeController::class);

Route::controller(EmployeeController::class)->prefix('employees')->group(function () {
    Route::get('index','index');
    Route::get('show/{employee}','show');
    Route::middleware('auth')->group(function () {
        Route::post('store','store');
        Route::patch('update/{employee}','update');
        Route::patch('assign/{employee}/restaurant','assignRestaurant');
        Route::delete('destroy/{employee}','destroy');
    });
});

Route::controller(RestaurantController::class)->prefix('restaurants')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('assignable','assignable');
    });
});
