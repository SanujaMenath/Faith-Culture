@extends('layouts.admin')
@section('title', 'Manage Colors')
@section('content')
    <div class="p-4 sm:p-8 bg-gray-100 min-h-screen">
        <!-- Page Header -->
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2 sm:mb-4">Manage Colors</h1>
            <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6">Fill in the form below to add a new color.</p>
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
            <!-- Add Color Form -->
            <div class="mb-8">
                <form action="{{ route('admin.addColorForm') }}" method="POST"
                    class="bg-white shadow-md rounded px-4 sm:px-8 pt-4 sm:pt-6 pb-6 sm:pb-8 w-full max-w-lg mx-auto">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Color Name</label>
                        <input type="text" name="name" id="name"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter color name" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                            Add Color
                        </button>
                    </div>
                </form>
            </div>
            <!-- Colors List Section -->
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 my-8">All Colors</h2>
                <!-- Responsive Table -->
                <div class="overflow-x-auto max-w-2xl bg-white shadow-md rounded mx-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Color Name
                                </th>
                                <th scope="col"
                                    class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($colors as $color)
                                <tr>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm sm:text-base text-gray-900">
                                        {{ $color->name }}
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
            </div>
        </div>
    </div>
@endsection