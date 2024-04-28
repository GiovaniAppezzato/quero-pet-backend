<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreAdminRequest;
use App\Enums\UserTypeEnum;
use App\Models\User;
class AdminController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::admins()->get());
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function store(StoreAdminRequest $request): UserResource
    {
        $validated = $request->validated();

        // ** Create a new user record.
        $user = User::create([
            ...$validated->user,
            'password'     => bcrypt($request->password),
            'user_type_id' => UserTypeEnum::ADMIN->value
        ])->admin()->create($validated->admin);

        return new UserResource($user);
    }

    public function update(Request $request, User $user): UserResource
    {
        $validated = $request->validated();

        // ** Update the user record.
        $user->update($validated->user);

        // ** Update the admin record.
        $user->admin->update($validated->admin);

        return new UserResource($user);
    }
}
