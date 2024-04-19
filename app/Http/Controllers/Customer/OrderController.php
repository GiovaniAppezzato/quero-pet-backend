<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
