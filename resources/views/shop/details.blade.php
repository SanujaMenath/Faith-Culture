@extends('layouts.app')

@section('title', $product->name . ' - Faith Culture')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="flex gap-6 flex-col md:flex-row">
        <!-- Product Image Section -->
<div class="flex-1">
    <div x-data="productImages({{ $variants }})">
        <img :src="currentImage" class="w-full h-96 object-cover rounded shadow" />

        <div class="flex gap-2 mt-4 overflow-x-auto">
        <template x-for="variant in variants" :key="variant.id">
    <template x-if="variant.image_url">
        <img :src="'/storage/' + variant.image_url"
             class="w-16 h-16 object-cover border rounded cursor-pointer"
             :class="{ 'ring-2 ring-blue-500': currentImage === ('/storage/' + variant.image_url) }"
             @click="setImage('/storage/' + variant.image_url)">
    </template>
</template>

        </div>
    </div>
</div>


        <!-- Product Details Section -->
        <div class="flex-1">
            <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
            <p class="text-gray-700 mb-4">{{ $product->description }}</p>

            <div x-data="productVariants({{ $variants }})">
                <!-- Color Selection -->
                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Available Colors:</h3>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="color in availableColors" :key="color">
                            <button 
                                class="px-3 py-1 border rounded"
                                :class="{ 'bg-black text-white': selectedColor === color }"
                                @click="selectColor(color)"
                                x-text="color">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Size Selection -->
                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Available Sizes:</h3>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="size in availableSizes" :key="size">
                            <button 
                                class="px-3 py-1 border rounded"
                                :class="{ 'bg-black text-white': selectedSize === size }"
                                @click="selectSize(size)"
                                x-text="size">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Price -->
                <div class="text-xl font-bold text-blue-600 mb-4">
                    <template x-if="currentVariant">
                        <span>Rs. <span x-text="currentVariant.price"></span></span>
                    </template>
                    <template x-if="!currentVariant">
                        <span>Select options to see price</span>
                    </template>
                </div>

                <!-- Availability -->
                <div class="mb-4">
                    <template x-if="currentVariant">
                        <span x-text="currentVariant.in_stock ? 'In Stock' : 'Out of Stock'" 
                              :class="currentVariant.in_stock ? 'text-green-600' : 'text-red-600'">
                        </span>
                    </template>
                </div>

                <!-- Add to Cart Form -->
                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="variant_id" :value="currentVariant ? currentVariant.id : ''">
                    <button type="submit"
                            class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-700"
                            :disabled="!currentVariant || !currentVariant.in_stock">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function productImages(variants) {
    return {
        variants: variants,
        currentImage: '/storage/' + (variants.length > 0 ? variants[0].image_url : ''),
        setImage(image) {
            this.currentImage = image;
        }
    }
}


    function productVariants(variants) {
        return {
            variants: variants,
            selectedColor: null,
            selectedSize: null,
            currentVariant: null,
            
            get availableColors() {
                return [...new Set(this.variants.map(v => v.color))];
            },
            
            get availableSizes() {
                if (!this.selectedColor) return [];
                return [...new Set(this.variants
                    .filter(v => v.color === this.selectedColor)
                    .map(v => v.size))];
            },
            
            selectColor(color) {
                this.selectedColor = color;
                // Reset size when color changes
                this.selectedSize = null;
                this.updateCurrentVariant();
            },
            
            selectSize(size) {
                this.selectedSize = size;
                this.updateCurrentVariant();
            },
            
            updateCurrentVariant() {
                if (this.selectedColor && this.selectedSize) {
                    this.currentVariant = this.variants.find(v => 
                        v.color === this.selectedColor && 
                        v.size === this.selectedSize
                    );
                } else {
                    this.currentVariant = null;
                }
            }
        }
    }
</script>
@endsection