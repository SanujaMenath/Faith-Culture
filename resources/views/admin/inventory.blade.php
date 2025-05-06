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

                <form method="POST" action="{{ route('admin.manageInventory') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="product_id" name="product_id" required>
                                    <option selected disabled>-- Select Product --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                <label for="product_id">Product</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="color" name="color" placeholder="Color">
                                <label for="color">Color</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="size" name="size" placeholder="Size">
                                <label for="size">Size</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="price" name="price" placeholder="Price (Rs)">
                                <label for="price">Price (Rs)</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity"
                                    placeholder="Quantity">
                                <label for="stock_quantity">Quantity</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image_url" class="form-label">Product Image</label>
                                <input class="" type="file" id="image_url" name="image_url">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-0">
                        <div class="d-grid">
                            <button type="submit"
                                class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Add
                                Inventory</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection