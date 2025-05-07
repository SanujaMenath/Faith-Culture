@extends('layouts.admin')

@section('title', 'Manage Inventory')

@section('content')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <h1 class="mt-4">Manage Inventory</h1>
            <p class="mb-4">Here you can manage your inventory.</p>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div id="successAlert"
                    class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative">
                    <span class="block">{{ session('success') }}</span>
                    <button type="button" onclick="document.getElementById('successAlert').style.display='none'"
                        class="absolute top-0 right-0 mt-2 mr-2 text-green-700 hover:text-green-900 font-bold">×</button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-700">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.manageInventory') }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="product_id" name="product_id" required>
                                <option selected disabled>-- Select Product --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="product_id">Product</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="color_id" name="color_id" required>
                                <option selected disabled>-- Select Color --</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>
                                        {{ $color->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="color_id">Color</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="size_id" name="size_id" required>
                                <option selected disabled>-- Select Size --</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}" {{ old('size_id') == $size->id ? 'selected' : '' }}>
                                        {{ $size->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="size_id">Size</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Price (Rs)">
                            <label for="price">Price (Rs)</label>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity') }}" placeholder="Quantity">
                            <label for="stock_quantity">Quantity</label>
                            @error('stock_quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="image_url" name="image_url">
                            @error('image_url')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-0">
                    <div class="d-grid">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Add Inventory
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
