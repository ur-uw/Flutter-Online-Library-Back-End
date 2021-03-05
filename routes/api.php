<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logOut']);
Route::get('/books',[UserBookController::class,'getAllBooks']);
//Routes protected by api middleware
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/logout', [AuthController::class, 'logOut']);
    Route::get('/user/books',[UserBookController::class,'getUserBooks']);
});

