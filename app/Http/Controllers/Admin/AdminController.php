<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(StoreAdminRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try{
            $admin = $request->validated();

            $admin->user()->create([
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $admin = Admin::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name
            ]);

            $credentials = $request->only('email', 'password');

            $user = Auth::user();

            DB::commit();

            return response()->json([
                'user' => $user,
            ], 201);
        }catch(\Exception $e) {

            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage(),
                ], 500);
        }
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $admin->update($request->validated());

        return response()->json([
            'success' => true,
            'customer' => $admin
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
