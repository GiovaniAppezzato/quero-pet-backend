<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class OngController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::ongs()->paginate());
    }

    public function show($id)
    {
        return new UserResource(User::ongs()->findOrFail($id));
    }
}
