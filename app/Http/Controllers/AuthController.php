<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
    public function register(Request $request): \Illuminate\Http\JsonResponse{
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid inputs',
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $user = User::create($validator->validated());
            $user->attachRole('user');
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'User created successfuly',
                'token' => $token,
                'user' => $user,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }

    }

    public function login(Request $request): \Illuminate\Http\JsonResponse{
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid inputs',
                'errors' => $validator->errors(),
            ]);
        }

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ]);
        }
        $user = User::where('email', $request->email)->first();
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'Token created successfuly',
            'token' => $tokenResult,
            'user' => $user,
        ]);
    }

    public function logOut(Request $request): \Illuminate\Http\JsonResponse {
        try {
            $request->user()->tokens()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Tokens Deleted!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'exception_class' => get_class($e),
            ]);
        }
    }
}
