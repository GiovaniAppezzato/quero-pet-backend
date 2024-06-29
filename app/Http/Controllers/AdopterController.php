<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class AdopterController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::adopters()->paginate());
    }

    public function show($id): UserResource
    {
        return new UserResource(User::adopters()->findOrFail($id));
    }
}
