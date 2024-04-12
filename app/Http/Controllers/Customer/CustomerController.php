<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'user' => $user,
        ], 200);
    }
    public function store(StoreCustomerRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try{
            $customer = $request->validated();

            $customer->user()->create([
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $customer = Customer::create([
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
}
