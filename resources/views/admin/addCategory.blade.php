@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Add New Category</h1>
        <p class="text-gray-600 mb-6">Fill in the form below to add a new category.</p>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong class="font-bold">Whoops!</strong>
                <span class="block">{{ $errors->first() }}</span>
            </div>
        @endif

        @if (session('success'))
            <div id="successAlert"
                class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative">
                <span class="block">{{ session('success') }}</span>
                <button type="button" onclick="document.getElementById('successAlert').style.display='none'"
                    class="absolute top-0 right-0 mt-2 mr-2 text-green-700 hover:text-green-900 font-bold">×</button>
            </div>
        @endif

        <form action="{{ route('admin.addCategoryForm') }}" method="POST"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-lg">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Category Name</label>
                <input type="text" name="name" id="name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Enter category name" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add Category
                </button>
            </div>
        </form>
    </div>
@endsection