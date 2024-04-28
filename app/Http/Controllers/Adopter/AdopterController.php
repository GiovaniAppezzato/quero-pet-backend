<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Adopter;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAdopterRequest;
use App\Http\Requests\UpdateAdopterRequest;

class adopterController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'user' => $user,
        ], 200);
    }
    public function store(StoreAdopterRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try{
            $adopter = $request->validated();

            $adopter->user()->create([
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $adopter = Adopter::create([
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
                'user' => $user,
                'token' => $token,
            ], 201);

        }catch(\Exception $e) {

        DB::rollBack();

        return response()->json([
            'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function confirmPassword(Request $request)
    {
        $password = $request['password'];

        if(Hash::check($password, Auth::user()->password)) {
            return response()->json([
                'status' => true,
            ], 200);
        }

        return response()->json([
            'status' => false,
        ], 200);
    }

    public function update(UpdateAdopterRequest $request, Adopter $adopter): JsonResponse
    {
        $data = $request->validated();
        $adopter->update($data);

        return response()->json([
            'success' => true,
            'adopter' => $adopter
        ], 200);
    }

    public function resetLoggedPassword(User $user, Request $request)
    {
        $this->validate($request, [
            'new_password' => 'required|confirmed|min:8',
        ]);

        $newPassword = $request->input('new_password');

        $user->update([
            'password' => bcrypt($newPassword),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password reseted successfully',
        ], 200);
    }
}