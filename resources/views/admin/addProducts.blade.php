@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
    <div class="p-4 sm:p-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2 sm:mb-4">Add New Product</h1>
            <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6">Fill in the form below to add a new product.</p>

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Success Message --}}
            @if (session('success'))
                <div id="successAlert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-md relative">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" onclick="document.getElementById('successAlert').style.display='none'"
                        class="absolute top-0 right-0 mt-4 mr-4 text-green-700 hover:text-green-900">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Add Product Form --}}
            <div class="mb-8">
                <form action="{{ route('admin.addProductsForm') }}" method="POST" enctype="multipart/form-data"
                    class="bg-white shadow-md rounded px-4 sm:px-8 pt-4 sm:pt-6 pb-6 sm:pb-8 w-full max-w-lg mx-auto">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
                        <input type="text" name="name" id="name" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" 
                            value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea name="description" id="description" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror" 
                            rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 font-medium mb-2">Category</label>
                        <select name="category_id" id="category_id" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('category_id') border-red-500 @enderror" 
                            required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" 
                            class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                            Add Product
                        </button>
                    </div>
                </form>
            </div>

            {{-- Products List Section --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">All Products</h2>
                
                {{-- Responsive Table for Products --}}
                <div class="overflow-x-auto hidden md:block bg-white shadow-md rounded">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Product Name
                                </th>
                                <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Created At
                                </th>
                                <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                        {{ $product->description }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->category->name }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                        <a href="#" onclick="confirmDelete({{ $product->id }})" class="text-red-600 hover:text-red-900">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 sm:px-6 py-4 text-center text-sm text-gray-500">
                                        No products found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- Mobile Product Cards (Visible only on smallest screens) --}}
                <div class="md:hidden mt-4 space-y-4">
                    @forelse ($products as $product)
                        <div class="bg-white p-4 rounded shadow">
                            <div class="font-bold text-gray-900 mb-1">{{ $product->name }}</div>
                            <div class="text-xs text-gray-600 mb-2 truncate">{{ $product->description }}</div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs bg-gray-200 px-2 py-1 rounded">{{ $product->category->name }}</span>
                                <span class="text-xs text-gray-500">{{ $product->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-end space-x-3 mt-2 pt-2 border-t border-gray-100">
                                <a href="" class="text-xs text-blue-600 hover:text-blue-900">Edit</a>
                                <a href="#" onclick="confirmDelete({{ $product->id }})" class="text-xs text-red-600 hover:text-red-900">Delete</a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-4 rounded shadow text-center text-gray-500">
                            No products found.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal (Hidden by default) --}}
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 sm:p-8 max-w-md mx-4 sm:mx-auto">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Confirm Delete</h3>
            <p class="text-gray-700 mb-6">Are you sure you want to delete this product? This action cannot be undo.</p>
            <div class="flex justify-end space-x-4">
                <button onclick="cancelDelete()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-800 transition duration-200">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-white transition duration-200">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // For the success alert dismissal
        setTimeout(function() {
            const successAlert = document.getElementById('successAlert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 5000);

        // For the delete modal
        function confirmDelete(productId) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            
            // Set the form action
            form.action = `/admin/products/${productId}/delete`;
            
            // Show the modal
            modal.classList.remove('hidden');
        }

        function cancelDelete() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }
    </script>
@endsection