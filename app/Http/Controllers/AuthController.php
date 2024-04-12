<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthenticateResource;
use App\Http\Requests\AuthenticateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\User;

class AuthController extends Controller
{
    public function store(AuthenticateRequest $request): JsonResponse
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

        return Response::json('Credenciais inválidas', 401);
    }

    public function destroy(Request $request): JsonResponse
    {
        // ** Revoke all tokens for the authenticated user.
        $request->user()->tokens()->delete();

        return response()->json(null, 200);
    }
}
