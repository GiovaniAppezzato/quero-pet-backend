<?php

namespace App\Http\Controllers\Ong;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        //Get all the orders that have this ong id
        
        $ongId = Auth::user()->ong->id;

        $orders = Order::where('ong_id', $ongId)->get();

        return response()->json([
            'orders' => $orders
        ], 200);
    }

    public function show($orderId)
    {
        $order = Order::find($orderId);
        $adopter = $order->adopter;

        return response()->json([
            'order' => $order,
            'adopter' => $adopter
        ], 200);
    }

    public function acceptOrder($orderId)
    {
        return DB::transaction(function () use ($orderId) {
            $order = Order::findOrFail($orderId);
            $order->update([
                'status' => 'accepted',
                'adopted_at' => now(),
            ]);
        });
    }

    public function cancelOrder($orderId)
    {
        return DB::transaction(function () use ($orderId) {
            $order = Order::findOrFail($orderId);
            $order->update([
                'status' => 'canceled',
                'canceled_at' => now(),
            ]);
        });
    }
}
