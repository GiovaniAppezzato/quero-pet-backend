<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;


class AdminController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::admins()->paginate());
    }

    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }
}
