@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold m-4">Add New Hero Slide</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md space-y-6 max-w-2xl mt-2 ml-2">
        @csrf

        <!-- Image Upload -->
        <div>
            <label for="image" class="block font-semibold mb-1">Slide Image <span class="text-red-500">*</span></label>
            <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Title -->
        <div>
            <label for="title" class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('title') }}">
        </div>

        <!-- Subtitle -->
        <div>
            <label for="subtitle" class="block font-semibold mb-1">Subtitle</label>
            <input type="text" name="subtitle" id="subtitle" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('subtitle') }}">
        </div>

        <!-- Button Text -->
        <div>
            <label for="button_text" class="block font-semibold mb-1">Button Text</label>
            <input type="text" name="button_text" id="button_text" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('button_text') }}">
        </div>

        <!-- Button Link -->
        <div>
            <label for="button_link" class="block font-semibold mb-1">Button Link</label>
            <input type="text" name="button_link" id="button_link" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('button_link') }}">
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-800 transition">Add Slide</button>
        </div>
    </form>
@endsection
