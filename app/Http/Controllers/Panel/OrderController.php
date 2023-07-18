<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('panel.table', ['service' => "OrdersService", 'title' => 'الطلبات']);
    }

    public function assigned()
    {
        return view('panel.table', ['service' => "OrdersService", 'title' => 'الطلبات المسندة']);
    }

    public function profile(Order $order)
    {
        return view('panel.orders.profile', ['order' => $order, 'title' => "طلب {$order->order_code}"]);
    }
}
