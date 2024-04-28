<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::all();

        return response()->json([
            'pets' => $pets
        ]);
    }

    public function store(StorePetRequest $request): JsonResponse
    {
        $data = $request->validated();

        $pet = Pet::create($data);

        return response()->json([
            'success' => true,
            'pet' => $pet
        ], 201);
    }

    public function update(UpdatePetRequest $request, Pet $pet): JsonResponse
    {
        $data = $request->validated();
        $pet->update($data);

        return response()->json([
            'success' => true,
            'pet' => $pet
        ], 200);
    }

    public function destroy(Pet $pet): JsonResponse
    {
        $pet->delete();

        return response()->json(null, 200);
    }
}
