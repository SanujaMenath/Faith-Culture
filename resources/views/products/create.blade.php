<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="image">Product Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
    </div>

    <button type="submit">Save Product</button>
</form>
