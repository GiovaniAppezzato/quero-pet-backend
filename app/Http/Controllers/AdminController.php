<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOngsRequest;
use App\Http\Requests\StoreUserRequest;

class AdminController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'user' => $user,
        ], 200);
    }


    public function store(StoreAdminRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try{
            $admin = $request->validated();

            $admin->user()->create([
                'email'    => $request->email,
                'password' => $request->password
            ]);

            $admin = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'cpf'        => $request->cpf,
                'phone'      => $request->phone,
                'birth_date' => $request->birth_date,
            ]);

            $credentials = $request->only('email', 'password');

            if(Auth::attempt($credentials)){
                /** @var User $user */
                $user = Auth::user();
                $token = $user->createToken('jwt');
            }

            DB::commit();

            return response()->json([
                'admin' => $admin,
                'token' => $token,
            ], 201);

        }catch(\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
