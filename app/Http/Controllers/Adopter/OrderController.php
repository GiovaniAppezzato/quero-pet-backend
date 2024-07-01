<?php

namespace App\Http\Controllers\Adopter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Pet;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\Adopter\StoreOrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        return OrderResource::collection(Order::with('pet', 'ong')->whereAdopterId($auth->information->id)->get());
    }

    public function store(StoreOrderRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $pet = Pet::with('ong')->findOrFail($validated['pet_id']);

            $order = Order::create([
                'pet_id' => $pet->id,
                'ong_id' => $pet->ong->id,
                'adopter_id' => Auth::user()->information->id,
            ]);

            return new OrderResource($order);
        });
    }
}
