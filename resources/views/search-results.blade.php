<h2>Search Results for "{{ $query }}"</h2>

@forelse ($products as $product)
  <div class="border p-4 mb-4">
    <h3 class="text-lg font-bold">{{ $product->name }}</h3>
    <p>{{ $product->description }}</p>

    <div class="grid grid-cols-2 gap-2 mt-2">
      @foreach ($product->inventories as $variant)
        <div class="border p-2">
          <img src="{{ asset('storage/' . $variant->image_url) }}" class="h-20 w-20 object-cover">
          <p>Color: {{ $variant->color->name }}</p>
          <p>Size: {{ $variant->size->name }}</p>
          <p>Price: ${{ $variant->price }}</p>
        </div>
      @endforeach
    </div>
  </div>
@empty
  <p>No products found.</p>
@endforelse
