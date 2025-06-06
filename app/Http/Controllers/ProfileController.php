<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $editMode = $request->query('edit') === 'true';
        return view('profile', compact('editMode')); // <-- Passes $editMode to Blade
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        if ($user->role === 'ADMIN') {
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
        } elseif ($user->role === 'USER') { // or 'user' if that's what you're using
            return redirect()->route('profile')->with('success', 'Profile updated successfully!');
        }
        // Fallback
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

}
