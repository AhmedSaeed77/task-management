<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'auth-sign', 'controller' => AuthController::class], function () {
    Route::post('in', 'signIn');
    Route::post('up', 'signUp');
    Route::post('out', 'signOut')->middleware(['auth:api']);
});
