<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TaskController;
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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('data', [AuthController::class, 'data']);

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
    });
});

Route::post('createTask', [TaskController::class, 'store']);
Route::get('task', [TaskController::class, 'index']);
Route::get('task/{id}', [TaskController::class, 'show']);
Route::put('updateTask/{id}',  [TaskController::class, 'update']);
Route::delete('deleteTask/{id}',  [TaskController::class, 'destroy']);

Route::post('createSubtask/{id}', [SubtaskController::class, 'store']);
Route::put('updateSubtask/{id}',  [SubtaskController::class, 'update']);
Route::delete('deleteSubtask/{id}',  [SubtaskController::class, 'destroy']);
