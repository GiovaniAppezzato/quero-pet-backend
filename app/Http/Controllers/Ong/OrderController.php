<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $customer = Auth::user();

        $orders = Order::where('customer_id', $customer->id)->get();

        return response()->json([
            'orders' => $orders
        ]);
    }

    public function show($orderId): JsonResponse
    {
        $order = Order::findOrFail($orderId);

        return response()->json([
            'order' => $order
        ]);
    }

    public function destroy($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->delete();

        return response()->json([
            'order'  => $order,
        ], 201);
    }
}
