@extends('layoutS.admin')
@section('title', 'Manage Sizes')
@section('content')
    <div class="p-4 sm:p-8 bg-gray-100 min-h-screen">
        <!-- Page Header -->
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2 sm:mb-4">Manage Sizes</h1>
            <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6">Fill in the form below to add a new size.</p>
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
            <!-- Add Size Form -->
            <div class="mb-8">
                <form action="{{ route('admin.addSizeForm') }}" method="POST"
                    class="bg-white shadow-md rounded px-4 sm:px-8 pt-4 sm:pt-6 pb-6 sm:pb-8 w-full max-w-lg mx-auto">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Size Name</label>
                        <input type="text" name="name" id="name"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter size name" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                            Add Size
                        </button>
                    </div>
                </form>
            </div>
            <!-- Sizes List Section -->
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4">All Sizes</h2>
                <!-- Responsive Table -->
                <div class="overflow-x-auto hidden sm:block bg-white shadow-md rounded">
                    <table class="min-w-xl divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Size Name
                                </th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($sizes as $size)
                                <tr>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm sm:text-base text-gray-900">
                                        {{ $size->name }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm sm:text-base text-gray-900">
                                        <form action="" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 font-bold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Mobile View -->
                <div class="sm:hidden bg-white shadow-md rounded">
                    <ul class="divide-y divide-gray-200">
                        @foreach ($sizes as $size)
                            <li class="px-4 sm:px-6 py-4">
                                <div class="flex items
                                    justify-between text-sm sm:text-base text-gray-900">
                                    <span class="font-medium">{{ $size->name }}</span>
                                    <form action="" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 font-bold">Delete</button>
                                    </form>
                                </div>
                                
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection