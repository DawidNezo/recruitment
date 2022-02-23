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

Route::controller(EmployeeController::class)->prefix('employees')->name('employees.')->group(function () {
    Route::get('index','index')->name('index');
    Route::get('show/{employee}','show')->name('show');
    Route::middleware('auth')->group(function () {
        Route::post('store','store')->name('store');
        Route::patch('update/{employee}','update')->name('update');
        Route::patch('assign/{employee}/restaurant','assignRestaurant')->name('assign.restaurant');
        Route::delete('destroy/{employee}','destroy')->name('destroy');
    });
});

Route::controller(RestaurantController::class)->prefix('restaurants')->name('restaurants.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('assignable/{employee_id}','assignable')->name('assignable');
    });
});
