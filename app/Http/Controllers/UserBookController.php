<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserBookController extends Controller
{

    /**
     * Display the specified resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserBooks(Request $request): JsonResponse
    {
        $user=$request->user();
        $userBooks=$user->books;
        return  response()->json($userBooks);
    }

}
