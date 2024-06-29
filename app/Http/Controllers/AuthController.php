<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthenticateResource;
use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\ConfirmPasswordRequest;
use App\Http\Requests\RecoverPasswordRequest;
use App\Http\Resources\UserResource;
use App\Mail\RecoverPassword;
use App\Models\User;

class AuthController extends Controller
{
    public function store(AuthenticateRequest $request): AuthenticateResource|JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            /** @var User $user */
            $user = Auth::user();
            $authToken = $user->createToken('authToken');

            return new AuthenticateResource([
                'plain_text_token' => $authToken->plainTextToken,
                'user' => $user
            ]);
        }

        return Response::json("The provided credentials are incorrect.", 401);
    }

    public function destroy(Request $request): JsonResponse
    {
        // ** Revoke all tokens for the authenticated user.
        $request->user()->tokens()->delete();

        return response()->json(null, 200);
    }

    public function show(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function confirmPassword(ConfirmPasswordRequest $request): JsonResponse
    {
        // ** Check if the password is correct.
        if(Hash::check($request->password, Auth::user()->password)) {
            return Response::json(true, 200);
        }

        return Response::json(false, 401);
    }

    public function recoverPassword(RecoverPasswordRequest $request): JsonResponse
    {
        $user = User::whereEmail($request->email)->first();

        if($user) {
            $password = rand(100000, 999999);

            // ** Update the user password.
            $user->password = bcrypt($password);
            $user->save();

            Mail::to($user->email)->send(new RecoverPassword($user, $password));
        }

        return Response::json(null, 200);
    }
}
