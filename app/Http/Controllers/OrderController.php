<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function getPaidOrders()
    {
        $orders = Order::where('status_bayar', true)->latest()->get();
        return response()->json([
            'data' => $orders,
            'count' => $orders->count()
        ]);
    }
}
