<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Project\ProjectController;
use App\Http\Controllers\Api\Task\TaskController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::group(['prefix' => 'auth-sign', 'controller' => AuthController::class], function () {
    Route::post('in', 'signIn');
    Route::post('up', 'signUp');
    Route::post('out', 'signOut')->middleware(['auth:api']);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('projects',ProjectController::class);

    Route::middleware('project.owner')->group(function () {
        Route::get('projects/{project}', [ProjectController::class, 'show']);
        Route::put('projects/{project}', [ProjectController::class, 'update']);
        Route::delete('projects/{project}', [ProjectController::class, 'destroy']);
    });
});

Route::middleware(['auth:api'])->group(function () {

    Route::apiResource('tasks', TaskController::class);

    Route::middleware('task.owner')->group(function () {
        Route::get('tasks/{task}', [TaskController::class, 'show']);
        Route::put('tasks/{task}', [TaskController::class, 'update']);
        Route::delete('tasks/{task}', [TaskController::class, 'destroy']);
    });

});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:api');
