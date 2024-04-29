<?php

namespace App\Http\Controllers\Ong;

use App\Models\Ong;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOngRequest;
use App\Http\Requests\UpdateOngRequest;

class OngController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'user' => $user,
        ], 200);
    }

    public function store(StoreOngRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try{
            $ong = $request->validated();

            $ong->user()->create([
                'email'    => $request->email,
                'password' => $request->password
            ]);

            $ong = Ong::create([
                'name'              => $request->name,
                'description'       => $request->description,
                'cnpj'              => $request->cnpj,
                'phone'             => $request->phone,
                'responsible_name'  => $request->responsible_name,
                'responsible_phone' => $request->responsible_phone,
                'responsible_cpf'   => $request->responsible_cpf,
                'status'            => $request->status,
            ]);

            $credentials = $request->only('email', 'password');

            if(Auth::attempt($credentials)){
                /** @var User $user */
                $user = Auth::user();
                $token = $user->createToken('jwt');
            }

            DB::commit();

            return response()->json([
                'ong' => $ong,
                'token' => $token,
            ], 201);
        }catch(\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateOngRequest $request, Ong $ong): JsonResponse
    {
        $data = $request->validated();
        $ong->update($data);

        //Retorno em JSON, ou como uma view qualquer?
        return response()->json([
            'success' => true,
            'ong' => $ong
        ]);
    }
}
