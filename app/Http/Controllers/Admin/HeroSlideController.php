<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::all();
        return view('admin.editHome', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero_slides-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
        ]);

        $data['image'] = $request->file('image')->store('hero_slides', 'public');
        HeroSlide::create($data);

        return redirect()->route('admin.view-hero-slides')->with('success', 'Slide added successfully.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero_slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $data = $request->validate([
            'image' => 'nullable|image',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hero_slides', 'public');
        }

        $heroSlide->update($data);

        return redirect()->route('admin.editHome')->with('success', 'Slide updated.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        $heroSlide->delete();
        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide deleted.');
    }
}

