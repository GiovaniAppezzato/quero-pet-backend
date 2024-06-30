<?php

namespace App\Http\Controllers\Ong;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ong\{StoreOngRequest,UpdateOngRequest};
use App\Http\Resources\UserResource;
use App\Enums\UserTypeEnum;
use App\Models\User;

class OngController extends Controller
{
    public function store(StoreOngRequest $request): UserResource
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();

            
            // ** Create the user record.
            $user = User::create([
                ...$validated['user'],
                'password'     => bcrypt($validated['user']['password']),
                'user_type_id' => UserTypeEnum::ONG->value,
            ]);
            
            if($request->hasFile('photo_path')) {
                $file = $request->file('photo');
                $extension = $file->extension();

                $hash = md5($file->getClientOriginalName() . strtotime('now')) . "." . $extension;
                $file->storeAs('users', $hash);

                $user->photo_path = $hash;
                $user->save();
            }

            // ** Create the ong record.
            $user->ong()->create($validated['ong']);

            // ** Create the address record.
            $user->address()->create($validated['address']);

            return new UserResource($user);
        });
    }

    public function update(UpdateOngRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $user = User::ongs()->findOrFail(Auth::id());

            // ** Update the user record.
            $user->update($validated['user']);

            // ** Update the ong record.
            $user->ong->update($validated['ong']);

            // ** Update the address record.
            $user->address->update($validated['address']);

            return new UserResource($user);
        });
    }
}
