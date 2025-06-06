@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Edit Shop the Look</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.shop-look.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Model Image --}}
        <div>
            <label class="block font-medium text-gray-700 mb-1">Model Image:</label>
            <input type="file" name="model_image" class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @if($look && $look->model_image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $look->model_image) }}" class="w-40 rounded shadow">
                </div>
            @endif
        </div>

        {{-- Top Image --}}
        <div>
            <label class="block font-medium text-gray-700 mb-1">Top Image:</label>
            <input type="file" name="top_image" class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <input type="text" name="top_product_link" placeholder="Top Product Link"
                class="mt-2 block w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                value="{{ $look->top_product_link ?? '' }}">
            @if($look && $look->top_image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $look->top_image) }}" class="w-40 rounded shadow">
                </div>
            @endif
        </div>

        {{-- Trouser Image --}}
        <div>
            <label class="block font-medium text-gray-700 mb-1">Trouser Image:</label>
            <input type="file" name="trouser_image" class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <input type="text" name="trouser_product_link" placeholder="Trouser Product Link"
                class="mt-2 block w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                value="{{ $look->trouser_product_link ?? '' }}">
            @if($look && $look->trouser_image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $look->trouser_image) }}" class="w-40 rounded shadow">
                </div>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full md:w-auto inline-block px-6 py-2 bg-gray-800 hover:bg-gray-600 text-white font-semibold text-sm rounded shadow transition">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
