<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    public function showAddProductsForm()
    {
        return view('admin.addProducts');
    }
    // AdminController.php

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        // Save to DB
        Category::create([
            'name' => $request->name
        ]);

        return back()->with('success', 'Category added');
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
