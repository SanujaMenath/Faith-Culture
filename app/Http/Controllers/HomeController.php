<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $newArrivals = Inventory::with('product.category')->latest()->take(4)->get();
        return view('home', compact('newArrivals'));
    }
}
