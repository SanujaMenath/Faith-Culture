<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return view('orders');
    }

    public function showOrders()
    {
        return view('orders.orders');
    }
}
