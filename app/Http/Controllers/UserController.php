<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use Whoops\Handler\JsonResponseHandler;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'user' => $user,
        ], 200);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        DB::beginTransaction();
        
        try{
            $user = $request->validated();
            $user = User::create($user);

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

        } catch(\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
