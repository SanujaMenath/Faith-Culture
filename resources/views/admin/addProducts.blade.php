@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
<div class="p-8 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Add New Product</h1>
    <p class="text-gray-600 mb-6">Fill in the form below to add a new product.</p>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <strong class="font-bold">Whoops!</strong>
            <span class="block">{{ $errors->first() }}</span>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.addProductsForm') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-lg">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
            <input type="text" name="name" id="name" class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" id="description" class="border rounded w-full px-3 py-2" rows="4"></textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-medium mb-2">Price (Rs)</label>
            <input type="number" name="price" id="price" step="0.01" min="100" class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-medium mb-2">Category</label>
            <select name="category_id" id="category_id" class="border rounded w-full px-3 py-2" required>
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="image" class="block text-gray-700 font-medium mb-2">Product Image</label>
            <input type="file" name="image" id="image" class="border rounded w-full px-3 py-2">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Add Product
            </button>
        </div>
    </form>
</div>
@endsection
