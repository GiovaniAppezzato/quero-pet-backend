<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Actions\SavePetPhotos;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PetResource;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;

class PetController extends Controller
{
    public function index()
    {
        return PetResource::collection(Pet::all());
    }

    public function show(Pet $pet): PetResource
    {
        return new PetResource($pet);
    }

    public function store(StorePetRequest $request): PetResource
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $pet = Pet::create($validated);

            if($request->has('photos')) {
                (new SavePetPhotos())->handle($pet, $validated->photos);
            }

            return new PetResource($pet);
        });
    }

    public function update(UpdatePetRequest $request, Pet $pet): PetResource
    {
        $validated = $request->validated();

        $pet->update($validated);

        return new PetResource($pet);
    }

    public function destroy(Pet $pet): JsonResponse
    {
        $pet->delete();
        return response()->json(null, 204);
    }
}
