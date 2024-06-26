<?php

namespace App\Http\Controllers\Adopter;

use App\Models\Pet;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $adopter = Auth::user()->adopter;
        $orders = Order::where('adopter_id', $adopter->id)->get();

        return response()->json([
            'orders' => $orders,
            'adopter' => $adopter
        ], 200);
    }

    public function show($orderId)
    {
        $order = Order::find($orderId);
        $pet = $order->pet;
        $adopter = $order->adopter;
        $ong = $order->ong;

        return response()->json([
            'order' => $order,
            'pet' => $pet,
            'adopter' => $adopter,
            'ong' => $ong
        ], 200);
    }

    public function store($petId) //Q: Or Request?
    {
        return DB::transaction(function () use ($petId) {
            $pet = Pet::findOrFail($petId);
            $user = Auth::user();

            $order = Order::create([
                'status' => 'pending',
                'pet_id' => $pet->id,
                'adopter_id' => $user->adopter->id,
                'ong_id' => $pet->ong->id,
            ]);

            //Q: Return again?
            return response()->json([
                'order' => $order,
                'success' => true
           ]);
       });
    }
}
