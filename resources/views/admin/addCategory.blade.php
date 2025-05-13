@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
    <div class="p-4 sm:p-8 bg-gray-100 min-h-screen">
        <!-- Page Header -->
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2 sm:mb-4">Add New Category</h1>
            <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6">Fill in the form below to add a new category.</p>

            <!-- Alert Messages -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 sm:mb-6">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block text-sm sm:text-base">{{ $errors->first() }}</span>
                </div>
            @endif

            @if (session('success'))
                <div id="successAlert"
                    class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 sm:mb-6 relative">
                    <span class="block text-sm sm:text-base">{{ session('success') }}</span>
                    <button type="button" onclick="document.getElementById('successAlert').style.display='none'"
                        class="absolute top-0 right-0 mt-2 mr-2 text-green-700 hover:text-green-900 font-bold">×</button>
                </div>
            @endif

            <!-- Add Category Form -->
            <div class="mb-8">
                <form action="{{ route('admin.addCategoryForm') }}" method="POST"
                    class="bg-white shadow-md rounded px-4 sm:px-8 pt-4 sm:pt-6 pb-6 sm:pb-8 w-full max-w-lg mx-auto">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Category Name</label>
                        <input type="text" name="name" id="name"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter category name" required>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                            Add Category
                        </button>
                    </div>
                </form>
            </div>

            <!-- Categories List Section -->
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4">All Categories</h2>

                <!-- Responsive Table -->
                <div class="overflow-x-auto hidden sm:block bg-white shadow-md rounded">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Category Name
                                </th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Created At
                                </th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($categories as $category)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $category->id }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $category->created_at->format('M d, Y H:i') }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                        <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 sm:px-6 py-4 text-center text-sm text-gray-500">
                                        No categories found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Category Cards (Visible only on smallest screens) -->
                <div class="sm:hidden mt-4 space-y-4">
                    @forelse ($categories as $category)
                        <div class="bg-white p-4 rounded shadow">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold">{{ $category->name }}</span>
                                <span class="text-xs text-gray-500">ID: {{ $category->id }}</span>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                Created: {{ $category->created_at->format('M d, Y H:i') }}
                            </div>
                            <div class="flex justify-end space-x-3">
                                <a href="#" class="text-xs text-blue-600 hover:text-blue-900">Edit</a>
                                <a href="#" class="text-xs text-red-600 hover:text-red-900">Delete</a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-4 rounded shadow text-center text-gray-500">
                            No categories found
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection