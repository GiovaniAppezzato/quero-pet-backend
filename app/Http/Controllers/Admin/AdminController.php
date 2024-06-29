<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\{StoreAdminRequest,UpdateAdminRequest};
use App\Http\Resources\UserResource;
use App\Enums\UserTypeEnum;
use App\Models\User;

class AdminController extends Controller
{
    public function store(StoreAdminRequest $request): UserResource
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if($request->hasFile('photo_path')) {
                // TODO: Implement the upload 'photo_path' logic.
            }

            $user = User::create([
                ...$validated['user'],
                'password'     => bcrypt($validated['user']['password']),
                'user_type_id' => UserTypeEnum::ADMIN->value
            ]);

            $user->admin()->create($validated['admin']);

            return new UserResource($user);
        });
    }

    public function update(UpdateAdminRequest $request): UserResource
    {
        return DB::transaction(function () use ($request) {
            $user = User::findOrFail(Auth::id());

            $validated = $request->validated();

            // ** Update the user record.
            $user->update($validated['user']);

            // ** Update the admin record.
            $user->admin->update($validated['admin']);

            return new UserResource($user);
        });
    }
}
