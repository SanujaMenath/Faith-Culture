<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\Inventory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::all();
        $newArrivals = Inventory::with('product.category')->latest()->take(4)->get();
        return view('home', compact('newArrivals','slides'));
    }
}
