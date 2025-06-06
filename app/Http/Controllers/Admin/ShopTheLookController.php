<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopTheLook;
use Illuminate\Http\Request;

class ShopTheLookController extends Controller
{

    public function update(Request $request)
    {
        $look = ShopTheLook::first() ?? new ShopTheLook();

        if ($request->hasFile('model_image')) {
            $look->model_image = $request->file('model_image')->store('images', 'public');
        }

        if ($request->hasFile('top_image')) {
            $look->top_image = $request->file('top_image')->store('products', 'public');
        }

        if ($request->hasFile('trouser_image')) {
            $look->trouser_image = $request->file('trouser_image')->store('products', 'public');
        }

        $look->top_product_link = $request->top_product_link;
        $look->trouser_product_link = $request->trouser_product_link;

        $look->save();

        return back()->with('success', 'Shop the Look section updated.');
    }
}
