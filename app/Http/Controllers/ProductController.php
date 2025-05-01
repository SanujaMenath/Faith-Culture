<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image
        ]);

        // Handle the image upload
        $imagePath = $request->file('image')->store('products', 'public'); // Store image in public/storage/products folder

        // Create a new product and save to the database
        $product = Product::create([
            'name' => $request->name,
            'image_url' => 'storage/' . $imagePath, // Save relative path
        ]);

        // Redirect to the products index page after saving
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }
}
