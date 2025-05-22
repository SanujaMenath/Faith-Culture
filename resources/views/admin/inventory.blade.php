@extends('layouts.admin')

@section('title', 'Manage Inventory')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2 sm:mb-4">Manage Inventory</h1>
            </div>
            <div class="card-body">
                {{-- Success Alert --}}
                @if (session('success'))
                    <div id="successAlert"
                        class="alert bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-6 relative"
                        role="alert">
                        <div class="flex">
                            <div class="py-1">
                                <svg class="h-6 w-6 text-green-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <span class="block font-medium">{{ session('success') }}</span>
                            </div>
                        </div>
                        <button type="button" onclick="document.getElementById('successAlert').style.display='none'"
                            class="absolute top-0 right-0 mt-2 mr-2 text-green-700 hover:text-green-900 font-bold">
                            <span class="text-xl">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="alert bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6 relative"
                        role="alert">
                        <div class="flex">
                            <div class="py-1">
                                <svg class="h-6 w-6 text-red-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <span class="block font-medium">Please fix the following errors:</span>
                                <ul class="list-disc list-inside mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Add Inventory Form --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Add New Inventory Item</h2>

                    <form method="POST" action="{{ route('admin.manageInventory') }}" enctype="multipart/form-data"
                        class="bg-white shadow-md rounded px-4 sm:px-8 pt-4 sm:pt-6 pb-6 sm:pb-8 w-full max-w-4xl mx-auto">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Product Selection --}}
                            <div class="mb-4">
                                <label for="product_id" class="block text-gray-700 font-medium mb-2">Product</label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="product_id" name="product_id" required>
                                    <option selected disabled>-- Select Product --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Color Selection --}}
                            <div class="mb-4">
                                <label for="color_id" class="block text-gray-700 font-medium mb-2">Color</label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="color_id" name="color_id" required>
                                    <option selected disabled>-- Select Color --</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Size Selection --}}
                            <div class="mb-4">
                                <label for="size_id" class="block text-gray-700 font-medium mb-2">Size</label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="size_id" name="size_id" required>
                                    <option selected disabled>-- Select Size --</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}" {{ old('size_id') == $size->id ? 'selected' : '' }}>
                                            {{ $size->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Price --}}
                            <div class="mb-4">
                                <label for="price" class="block text-gray-700 font-medium mb-2">Price (Rs)</label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="price" name="price" value="{{ old('price') }}" placeholder="Enter price" required>
                                @error('price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Stock Quantity --}}
                            <div class="mb-4">
                                <label for="stock_quantity" class="block text-gray-700 font-medium mb-2">Quantity</label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity') }}"
                                    placeholder="Enter quantity" required>
                                @error('stock_quantity')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Product Image --}}
                            <div class="mb-4">
                                <label for="image_url" class="block text-gray-700 font-medium mb-2">Product Image</label>
                                <div class="flex items-center">
                                    <label
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-white cursor-pointer flex items-center justify-center">
                                        <i class="fa-solid fa-cloud-arrow-up mr-2"></i>
                                        <span id="file-name">Select image</span>
                                        <input type='file' class="hidden" id="image_url" name="image_url" />
                                    </label>
                                </div>
                                @error('image_url')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button type="submit"
                                class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                                <i class="fa-solid fa-plus mr-2"></i>
                                Add Inventory Item
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Inventory List --}}
                <div class="mt-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Inventory Items</h2>

                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Color
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Size
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price (Rs)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Image
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($inventories as $inventory)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $inventory->product->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $inventory->color->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $inventory->size->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ number_format($inventory->price, 2) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $inventory->stock_quantity > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $inventory->stock_quantity }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img src="{{ asset('storage/' . $inventory->image_url) }}" alt="Product Image"
                                                class="h-10 w-10 rounded-full object-cover border border-gray-200">
                                        </td>
                                        <td class="flex px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                <span class="inline-flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                    Edit
                                                </span>
                                            </a>
                                            <form action="{{ route('admin.deleteInventory', $inventory->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete {{ $inventory->product->name }} ?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="flex text-red-600 hover:text-red-900 font-bold"><svg
                                                        class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                    Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            No inventory items found. Add your first item above.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination if exists --}}
                    @if(isset($inventories) && method_exists($inventories, 'links'))
                        <div class="mt-4">
                            {{ $inventories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Optional: Add JavaScript for enhanced file input --}}
    <script>
        // Display selected filename in the custom file input
        document.getElementById('image_url').addEventListener('change', function (e) {
            var fileName = e.target.files[0].name;
            var label = e.target.nextElementSibling;
            label.querySelector('span').innerHTML = fileName;
        });

        // Auto-hide success message after 5 seconds
        if (document.getElementById('successAlert')) {
            setTimeout(function () {
                document.getElementById('successAlert').style.display = 'none';
            }, 5000);
        }
    </script>
@endsection