<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthenticateResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\User;

class AuthController extends Controller
{
    public function signIn(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            /** @var User $user */
            $user = Auth::user();
            $authToken = $user->createToken('authToken');

            return Response::json([
                'token' => $authToken->plainTextToken,
                'user' => $user
            ], 201);

            /* return new AuthenticateResource([
                'token' => $authToken->plainTextToken,
                'user' => $user
            ]); */
        }

        return Response::json(null, 401);
    }
}
