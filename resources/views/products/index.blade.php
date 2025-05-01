@foreach ($products as $product)
    <div class="product">
        <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="w-full h-auto rounded">
        <h2>{{ $product->name }}</h2>
    </div>
@endforeach
