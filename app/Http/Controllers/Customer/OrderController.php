<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function store(Request $request)
    {
        DB::beginTransaction();

        try{
            $user = Auth::user();

            $order = Order::create([
                'status'      => 'pending',
                'pet_id'      => $request->pet_id,
                'customer_id' => $user->id,
                'ong_id'      => $request->ong_id
            ]);

            DB::commit();

            return response()->json([
                'order'  => $order,
            ], 201);
        }
        catch(\Exception $e){
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
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
