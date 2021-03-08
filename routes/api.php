<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/books', [BookController::class, 'index']);
//Routes protected by api middleware
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/logout', [AuthController::class, 'logOut']);
    Route::get('/user/books', [UserBookController::class, 'getUserBooks']);
});
