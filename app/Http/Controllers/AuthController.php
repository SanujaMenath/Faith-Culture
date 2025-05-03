<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.auth'); 
    }
    
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    
        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'USER',
        ]);
    
        auth()->login($user);
        return redirect()->route('login.form')->with('status', 'Registration successful! Please log in.');
    }
    
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return match (auth()->user()->role) {
                'ADMIN' => redirect('/admin/dashboard'),
                'STAFF' => redirect('/staff/dashboard'),
                default => redirect('/'),
            };
        }
    
        return redirect()->route('login.form')->with('status', 'Unuccessful attempt! Please Try Again.');
    }
    
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }
    
}
