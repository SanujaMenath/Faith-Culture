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
            // Add other fields if needed
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
