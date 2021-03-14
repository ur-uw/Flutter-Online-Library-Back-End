<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavouriteBookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookFavouriteController extends Controller
{
    public function favourite(FavouriteBookRequest $request): \Illuminate\Http\JsonResponse
    {
        $bookId = $request->validated();
        Auth::user()->favourites()->attach($bookId);
        return response()->json([
            'success' => true,
            'message' => 'Book added to favourites'
        ]);

    }

    public function unFavourite(FavouriteBookRequest $request): \Illuminate\Http\JsonResponse
    {

        $bookId = $request->validated();
        Auth::user()->favourites()->detach($bookId);

        return response()->json([
            'success' => true,
            'message' => 'Book removed from favourites'
        ]);

    }
}
