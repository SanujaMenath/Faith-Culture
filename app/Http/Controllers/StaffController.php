<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        return view('staff.index');
    }

    public function showStaffDashboard()
    {
        return view('staff.dashboard');
    }

    public function showStaffProfile()
    {
        return view('staff.profile');
    }

    public function showStaffOrders()
    {
        return view('staff.orders');
    }

    public function showStaffProducts()
    {
        return view('staff.products');
    }
}
