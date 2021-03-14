<?php

use App\Events\BooksEvent;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookFavouriteController;
use App\Http\Controllers\UserBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Routes protected by api middleware
Route::group(['middleware' => 'auth:sanctum'], function () {
    //Get user by token
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    //Logout
    Route::get('/logout', [AuthController::class, 'logOut']);
    //Books
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/user/books', [UserBookController::class, 'getUserBooks']);
    Route::post('/book/favourite',[BookFavouriteController::class,'favourite']);
    Route::post('/book/unFavourite',[BookFavouriteController::class,'unFavourite']);
    Route::get('/user/favourites', [UserBookController::class, 'getUserFavourites']);
});

//BroadCasting
Route::group(['prefix' => 'broadcast'], function () {
    Route::get('/books', function () {
        broadcast(new BooksEvent());
    });
});
