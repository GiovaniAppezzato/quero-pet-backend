<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreCustomerRequest;

class CustomerController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'user' => $user,
        ], 200);
    }
    public function store(StoreUserRequest $request, StoreCustomerRequest $costumerRequest): JsonResponse
    {
        DB::beginTransaction();
        
        try{
            $user = $request->validated();
            $customer = $costumerRequest->validated();

            $user = User::create($user);
            $customer = $user->customer()->create($customer);

            $user->address()->create([
                'zip_code'     => $request->zip_code,
                'street'       => $request->street,
                'number'       => $request->number,
                'neighborhood' => $request->neighborhood,
                'city'         => $request->city,
                'state'        => $request->state,
                'country'      => $request->country,
                'complement'   => $request->complement,
                'reference_point' => $request->reference_point,
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
}