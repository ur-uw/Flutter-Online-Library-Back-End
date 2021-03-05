<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status_code'=>400,
                'errors' => $validator->errors()
            ]);
        }

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'message' => 'user created',
                'token' => $token,
                'user' => $user,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status_code' => 400,
                'message' => $exception->getMessage(),
            ]);
        }

    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $rules = [

            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->failed()) {
            return response()->json([
                'status_code' => 400,
                'message' => 'bad request'
            ]);
        }
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status_code' => 500,
                'message' => 'invalid credentials'
            ]);
        }
        $user = User::where('email', $request->email)->first();
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'status_code' => 200,
            'token' => $tokenResult,
            'user' => $user,
        ]);
    }

    public function logOut(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'tokens deleted'
        ]);
    }
}
