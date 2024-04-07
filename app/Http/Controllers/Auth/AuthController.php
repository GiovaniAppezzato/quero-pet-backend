<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function authenticate(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            /** @var User $user */
            $user = Auth::user();

            return response()->json([
                "token" => $user->createToken('jwt'),
                "user"  => $user,
            ]);
        }

        return response()->json([
            'message' => 'Credenciais inválidas'
        ], 401);

        // return response()->json(null, 403);
    }

    public function destroy(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(null, 200);
    }
}
