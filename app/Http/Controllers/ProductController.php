<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
    
        // Get in-stock inventory variants
        $variants = $product->inventories()
            ->where('stock_quantity', '>', 0)
            ->get()
            ->map(function ($inventory) {
                return [
                    'id' => $inventory->id,
                    'color' => $inventory->color,
                    'size' => $inventory->size,
                    'price' => $inventory->price,
                    'sku' => $inventory->sku,
                    'in_stock' => $inventory->stock_quantity > 0,
                    'image_url' => $inventory->image_url,
                ];
            });
    
        return view('shop.details', [
            'product' => $product,
            'variants' => $variants->toJson(),
        ]);
    }
    

    
}
