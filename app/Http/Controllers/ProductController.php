<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
       
    }
    public function productDetails($id)
    {
        $product = Product::with('inventories.color', 'inventories.size')->findOrFail($id);

        $variants = $product->inventories->map(function ($inventory) {
            return [
                'inventory_id' => $inventory->id,
                'color' => $inventory->color->name,
                'color_id' => $inventory->color->id,
                'size' => $inventory->size->name,
                'size_id' => $inventory->size->id,
                'price' => $inventory->price,
                'stock_quantity' => $inventory->stock_quantity,
                'image_url' => $inventory->image_url,
                'in_stock' => $inventory->stock_quantity > 0,
            ];
        });

        $colors = $variants->groupBy('color')->map(function ($group) {
            return [
                'name' => $group->first()['color'],
                'id' => $group->first()['color_id'],
                'in_stock' => $group->contains(fn($v) => $v['in_stock']),
            ];
        })->values();

        $sizes = $variants->groupBy('size')->map(function ($group) {
            return [
                'name' => $group->first()['size'],
                'id' => $group->first()['size_id'],
                'in_stock' => $group->contains(fn($v) => $v['in_stock']),
            ];
        })->values();

        return view('shop.details', [
            'product' => $product,
            'variants' => $variants,
        ]);
    }




}
