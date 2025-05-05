<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function editProfile()
    {
        return view('profile');
    }

    public function showAddCategoryForm()
    {
        return view('admin.addCategory');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return back()->with('success', 'Category added');
    }
    public function showAddProductsForm()
    {
        $categories = Category::all();
        return view('admin.addProducts', compact('categories'));
    }
    public function addProduct(Request $request)
{
    // 1. Validate input
    $validated = $request->validate([
        'name' => 'required|string|max:191',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'nullable|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // 5MB max
    ]);

    // 2. Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('public/products', $imageName);
        $imagePath = 'products/' . $imageName;
    }

    // 3. Create product
    Product::create([
        'name' => $validated['name'],
        'description' => $validated['description'] ?? null,
        'price' => $validated['price'],
        'category_id' => $validated['category_id'] ?? null,
        'image_url' => $imagePath,
    ]);

    // 4. Redirect back with success message
    return back()->with('success', 'Product added successfully.');
}


    public function editHomepage()
    {
        return view('admin.editHome');
    }

    public function showCreateStaffForm()
    {
        return view('admin.createStaff');
    }

    public function createStaff(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'STAFF',
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'Staff created');
    }

}
