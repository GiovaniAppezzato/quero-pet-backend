<?php

namespace App\Http\Controllers\Ong;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use App\Http\Requests\Ong\OngOrderRequest;

class OrderController extends Controller
{
    public function index(): OrderResource
    {
        $auth = Auth::user();
        return OrderResource::collection(Order::with('pet', 'adopter')->whereOngId($auth->information->id)->get());
    }

    public function show($id): OrderResource
    {
        $order = Order::with('pet', 'adopter')->findOrFail($id);
        return new OrderResource($order);
    }

    public function approveOrder(OngOrderRequest $request)
    {
        $orderId = $request->order_id;

        $order = Order::findOrFail($orderId)->update([
            'status' => 'accepted',
            'adopted_at' => now(),
        ]);

        // TODO: Send email to the adopter

        return new OrderResource($order);
    }

    public function cancelOrder(OngOrderRequest $request)
    {
        $orderId = $request->order_id;

        $order = Order::findOrFail($orderId)->update([
            'status' => 'canceled',
            'canceled_at' => now(),
        ]);

        // TODO: Send email to the adopter

        return new OrderResource($order);
    }
}
