<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $role = auth()->user()->role;

        switch ($role) {
            case 'admin':
                return view('dashboard.admin');
            case 'staff':
                return view('dashboard.staff');
            case 'customer':
                return view('dashboard.customer');
            default:
                abort(403, 'Unauthorized');
        }
    }

}
