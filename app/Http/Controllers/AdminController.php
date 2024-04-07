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


    public function store(StoreUserRequest $request, StoreAdminRequest $adminRequest): JsonResponse
    {
        DB::beginTransaction();
        
        try{
            $user = $request->validated();
            $admin = $adminRequest->validated();

            $user = User::create($user);
            $admin = $user->ong()->create($admin);

        }catch(\Exception $e) {
        DB::rollBack();
        
        return response()->json([
            'error' => $e->getMessage(),
        ], 500);
        }
    }
    
}
