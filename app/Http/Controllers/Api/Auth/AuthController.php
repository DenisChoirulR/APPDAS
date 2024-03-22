<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'These credentials do not match our records'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login Success',
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

    public function getUser(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout Success'
        ]);
    }
}
