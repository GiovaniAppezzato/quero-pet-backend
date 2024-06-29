<?php

namespace App\Http\Controllers\Adopter;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Adopter\{StoreAdopterRequest, UpdateAdopterRequest};
use App\Http\Resources\UserResource;
use App\Enums\UserTypeEnum;
use App\Models\User;

class AdopterController extends Controller
{
    public function store(StoreAdopterRequest $request): UserResource
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();

            // ** Create the user record.
            $user = User::create([
                ...$validated,
                'password'     => bcrypt($validated['password']),
                'user_type_id' => UserTypeEnum::ADOPTER->value,
            ]);

            // ** Create the adopter record.
            $user->adopter()->create($validated);

            // ** Create the address record.
            $user->address()->create($validated);

            // ** Store the user photo.
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extension = $file->extension();

                $hash = md5($file->getClientOriginalName() . strtotime('now')) . "." . $extension;
                $file->storeAs('users', $hash);

                $user->photo_path = $hash;
                $user->save();
            }

            return new UserResource($user);
        });
    }

    public function update(UpdateAdopterRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $user = User::adopters()->findOrFail(Auth::id());

            // ** Update the user record.
            $user->update($validated);

            // ** Update the adopter record.
            $user->adopter->update($validated);

            // ** Update the address record.
            $user->address->update($validated);

            return new UserResource($user);
        });
    }
}
