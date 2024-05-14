<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Enums\UserTypeEnum;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::admins()->get());
    }

    public function show($id): UserResource
    {
        return new UserResource(User::findOrFail($id));
    }

    public function store(StoreAdminRequest $request): UserResource
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $user = User::create([
                ...$validated['user'],
                'password'     => bcrypt($request->password),
                'user_type_id' => UserTypeEnum::ADMIN->value,
                'created_by'   => Auth::id()
            ]);

            $user->admin()->create($validated['admin']);

            return new UserResource($user);
        });
    }

    public function update(UpdateAdminRequest $request, $id): UserResource
    {
        return DB::transaction(function () use ($request, $id) {
            $user = User::findOrFail($id);

            $validated = $request->validated();

            // ** Update the user record.
            $user->update($validated['user']);

            // ** Update the admin record.
            $user->admin->update($validated['admin']);

            return new UserResource($user);
        });
    }
}
