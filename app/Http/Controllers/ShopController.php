<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    

public function index()
{
    $categories = Category::all();
    $products = Product::all(); // Or filter by selected category
    return view('shop.index', compact('products', 'categories'));
}
public function filterByCategory($id)
{
    $products = Product::where('category_id', $id)->get(); // Filter by category
    $categories = Category::all(); // Still show all categories in the sidebar

    return view('shop.index', compact('products', 'categories'));
}

}
