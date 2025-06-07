@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Hero Carousel Slides</h2>
    <a href="{{ route('admin.hero-slides-create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Slide</a>

    @if(session('success'))
        <p class="text-green-600 mt-2">{{ session('success') }}</p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        @foreach($slides as $slide)
            <div class="border rounded p-4 shadow">
                <img src="{{ asset('storage/' . $slide->image) }}" class="w-full h-48 object-cover mb-2">
                <h4 class="font-bold">{{ $slide->title }}</h4>
                <p>{{ $slide->subtitle }}</p>
                <a href="{{ $slide->button_link }}" class="text-blue-600 underline">{{ $slide->button_text }}</a>
                <div class="mt-2 flex gap-2">
                    <a href="{{ route('admin.hero-slides.edit', $slide->id) }}" class="text-blue-600">Edit</a>
                    <form action="" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
