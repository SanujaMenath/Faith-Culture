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


    }

    public function profile()
    {

        switch (auth()->user()->role) {
            case 'ADMIN':
                return redirect('/admin/dashboard');
            case 'STAFF':
                return redirect('/staff/dashboard');
            case 'USER':
                return redirect()->route('profile');
            default:
                abort(403, 'Unauthorized action.');
        }

    }

}
