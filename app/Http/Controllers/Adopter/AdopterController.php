<?php

namespace App\Http\Controllers\Adopter;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdopterRequest;
use App\Http\Resources\UserResource;
use App\Enums\UserTypeEnum;
use App\Models\User;

class AdopterController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::adopters()->get());
    }

    public function show($id): UserResource
    {
        return new UserResource(User::findOrFail($id));
    }

    public function store(StoreAdopterRequest $request): UserResource
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();

            // ** Create the user record.
            $user = User::create([
                ...$validated['user'],
                'password'     => bcrypt($request->password),
                'user_type_id' => UserTypeEnum::ADOPTER->value,
            ]);

            // ** Create the adopter record.
            $user->adopter()->create($validated['adopter']);

            // ** Create the address record.
            $user->address()->create($validated['address']);

            return new UserResource($user);
        });
    }

    // TODO: Implement the update method.
}
