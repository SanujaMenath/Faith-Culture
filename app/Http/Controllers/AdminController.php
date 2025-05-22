<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
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
        return view('admin.profile');
    }

    public function showAddCategoryForm()
    {
        $categories = Category::all();
        return view('admin.addCategory', compact('categories'));
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
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success', 'Category deleted');
    }

    public function showAddProductsForm()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.addProducts', compact('categories', 'products'));
    }
    public function addProduct(Request $request)
    {
        // 1. Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // 2. Create product
        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
        ]);

        // 3. Redirect back with success message
        return back()->with('success', 'Product added successfully.');
    }

    public function deleteProduct($id){
        $product = Product::findOrFail($id);
        $product->delete();

        return back()->with('success', 'Product deleted');
    }

    public function viewInventory()
    {
        $colors = Color::with('inventories')->get();
        $sizes = Size::with('inventories')->get();
        $products = Product::with('inventories')->get();
        $inventories = Inventory::with(['product', 'color', 'size'])->get();

        return view('admin.inventory', compact('products', 'colors', 'sizes', 'inventories'));
    }

    public function manageInventory(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'stock_quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Check if inventory variant already exists
        $existing = Inventory::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
        ])->first();

        if ($existing) {
            return back()->withErrors(['duplicate' => 'This product variant already exists in inventory.']);
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imageName = time() . '.' . $request->file('image_url')->getClientOriginalExtension();
            $request->file('image_url')->storeAs('public/products', $imageName);
            $imagePath = 'products/' . $imageName;
        }

        // Save new inventory
        Product::find($request->product_id)->inventories()->create([
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'stock_quantity' => $request->stock_quantity,
            'price' => $request->price,
            'image_url' => $imagePath,
        ]);

        return back()->with('success', 'Inventory updated successfully.');
    }

    public function showAddSizeForm()
    {
        $sizes = Size::all();
        return view('admin.manageSizes', compact('sizes'));
    }
    public function addSize(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Size::create([
            'name' => $request->name
        ]);

        return back()->with('success', 'Size added');
    }

    public function deleteSize($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        return back()->with('success', 'Size deleted');
    }
    public function showAddColorForm()
    {
        $colors = Color::all();
        return view('admin.manageColors', compact('colors'));
    }
    public function addColor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Color::create([
            'name' => $request->name
        ]);

        return back()->with('success', 'Color added');
    }

    public function deleteColor($id){
        $colors = Color::findOrFail($id);
        $colors->delete();

        return back()->with('success', 'Color deleted');

    }

    public function editHomepage()
    {
        return view('admin.editHome');
    }

    public function showCreateStaffForm()
    {
        $staffs = User::where('role', 'STAFF')->get();
        return view('admin.createStaff', compact('staffs'));
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
