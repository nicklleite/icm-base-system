<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Http\Requests\Auth\ResetAccessRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

class AuthController extends Controller
{
    public function authenticate(AuthenticateRequest $request): JsonResponse
    {
        /**
         * TODO: Validation of the incoming data on `login` field to be done by the frontend application.
         */

        $loginField = (empty($request->get('username')))? 'email' : 'username';

        if (!Auth::attempt($request->only($loginField, 'password'))) {
            return response()->json([
                "message" => "Invalid Credentials!",
            ], HttpStatusCode::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $user->token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('sanctum', $user->token, 60 * 24);

        return (new UserResource($user))->response()->setStatusCode(HttpStatusCode::HTTP_OK)->withCookie($cookie);
    }

    public function reset(ResetAccessRequest $request)
    {

    }
}
