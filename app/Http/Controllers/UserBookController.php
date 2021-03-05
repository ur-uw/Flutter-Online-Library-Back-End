<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getAllBooks(): JsonResponse
    {
        $books=Book::latest()->get();
        return response()->json([
            'status_code'=>200,
            'books'=>$books,
        ]);
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserBooks(Request $request): JsonResponse
    {
        $user=$request->user();
        $userBooks=$user->books;
        return  response()->json([
            'status_code'=>200,
            'user_books'=>$userBooks
        ]);
    }

}
