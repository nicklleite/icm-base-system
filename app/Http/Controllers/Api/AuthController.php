<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(): JsonResponse
    {
        return response()->json([
            "message" => "Login Form!"
        ], HttpStatusCode::HTTP_OK);
    }

    public function authenticate(Request $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                "message" => "Invalid Credentials!"
            ], HttpStatusCode::HTTP_UNAUTHORIZED);
        }

        // Logged in!
        $user = Auth::user();
        $user->token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('sanctum', $user->token, 60 * 24);


        return (new UserResource($user))->response()->setStatusCode(HttpStatusCode::HTTP_OK)->withCookie($cookie);
    }
}
