@extends('layouts.app')

@section('title', $product->name . ' - Faith Culture')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Product Image Section -->
        <div class="md:w-md h-full">
            <div x-data="productImages({{ $variants }})">
                <!-- Increased height from h-96 to h-[600px] -->
                <div class="border rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="relative">
                        <img :src="currentImage" class="w-full h-128 object-cover transition duration-300 ease-in-out" />
                        <div class="absolute top-4 right-4 flex gap-2">
                            <button class="bg-white/80 hover:bg-white px-2 rounded-full shadow transition">
                            <i class="fa-regular fa-heart"></i>
                            </button>
                            <button class="bg-white/80 hover:bg-white px-2 rounded-full shadow transition">
                            <i class="fa-solid fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Enhanced Thumbnail Gallery -->
                <div class="flex gap-3 mt-4 overflow-x-auto py-2 px-1">
                    <template x-for="variant in variants" :key="variant.inventory_id">
                        <template x-if="variant.image_url">
                            <img :src="'/storage/' + variant.image_url"
                                 class="w-20 h-20 object-cover border rounded-lg cursor-pointer transition duration-200 shadow hover:shadow-md"
                                 :class="{ 'ring-2 ring-blue-500': currentImage === ('/storage/' + variant.image_url) }"
                                 @click="setImage('/storage/' + variant.image_url)">
                        </template>
                    </template>
                </div>
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="md:w-1/2 space-y-6" x-data="productVariants({{ $variants }})">
            <div>
                <h1 class="text-4xl font-bold mb-2">{{ $product->name }}</h1>
                
                <p class="text-gray-700 text-lg mb-2">{{ $product->description }}</p>
                <div class="p-3 border-l-4 border-blue-500 bg-blue-50 text-blue-700 text-sm mt-4">
                    Free shipping on orders over Rs. 20,000
                </div>
            </div>

            <!-- Color Selection -->
            <div>
                <h3 class="font-semibold text-lg mb-2">Select Color:</h3>
                <div class="flex flex-wrap gap-2">
                    <template x-for="color in availableColors" :key="color.name">
                        <button 
                            class="px-4 py-2 border rounded-md transition"
                            :class="{
                                'bg-black text-white border-black': selectedColor === color.name,
                                'opacity-50 cursor-not-allowed line-through': !color.in_stock,
                                'hover:bg-gray-100': color.in_stock
                            }"
                            :disabled="!color.in_stock"
                            @click="selectColor(color.name)"
                            x-text="color.name">
                        </button>
                    </template>
                </div>
            </div>

            <!-- Size Selection -->
            <div>
                <h3 class="font-semibold text-lg mb-2">Select Size:</h3>
                <div class="flex flex-wrap gap-2">
                    <template x-for="size in availableSizes" :key="size.name">
                        <button 
                            class="px-4 py-2 border rounded-md transition"
                            :class="{
                                'bg-black text-white border-black': selectedSize === size.name,
                                'opacity-50 cursor-not-allowed line-through': !size.in_stock,
                                'hover:bg-gray-100': size.in_stock
                            }"
                            :disabled="!size.in_stock"
                            @click="selectSize(size.name)"
                            x-text="size.name">
                        </button>
                    </template>
                </div>
            </div>

            <!-- Price & Availability -->
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-gray-900">
                    <template x-if="currentVariant">
                        <span>Rs. <span x-text="currentVariant.price"></span></span>
                    </template>
                    <template x-if="!currentVariant">
                        <span class="text-gray-500">Select color and size to view price</span>
                    </template>
                </div>
                <div>
                    <template x-if="currentVariant">
                        <span 
                            x-text="currentVariant.in_stock ? 'In Stock' : 'Out of Stock'"
                            :class="currentVariant.in_stock ? 'bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium' : 'bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium'">
                        </span>
                    </template>
                </div>
            </div>

            <!-- Quantity and Add to Cart -->
            <form method="POST" action="{{ route('cart.add') }}" >
                @csrf
                <input type="hidden" name="inventory_id" :value="currentVariant ? currentVariant.inventory_id : ''">

                <!-- Quantity Selector -->
                <div class="flex items-center gap-4 mb-6">
                    <label class="font-medium">Quantity:</label>
                    <div class="flex border rounded-md">
                        <button type="button" onclick="decrement()" class="px-2 py-1 hover:bg-gray-100 transition">−</button>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" class="w-16 text-center border-x" />
                        <button type="button" onclick="increment()" class="px-2 py-1 hover:bg-gray-100 transition">+</button>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                            class="bg-black text-white px-6 py-3 rounded-md font-semibold shadow hover:bg-gray-800 disabled:opacity-50 disabled:cursor-not-allowed flex-1 flex items-center justify-center gap-2 transition-colors duration-200"
                            :disabled="!currentVariant || !currentVariant.in_stock">
                            <i class="fa-solid fa-cart-shopping"></i>
                        Add to Cart
                    </button>
                    <button type="button"
                            class="border border-black px-6 py-3 rounded-md font-semibold hover:bg-gray-100 transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fa-regular fa-heart"></i>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Alpine.js Logic -->
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
                const uniqueColors = [...new Map(this.variants.map(v => [v.color, v])).values()];
                return uniqueColors.map(v => ({
                    name: v.color,
                    in_stock: this.variants.some(variant => variant.color === v.color && variant.in_stock)
                }));
            },

            get availableSizes() {
                if (!this.selectedColor) return [];
                const filtered = this.variants.filter(v => v.color === this.selectedColor);
                const uniqueSizes = [...new Map(filtered.map(v => [v.size, v])).values()];
                return uniqueSizes.map(v => ({
                    name: v.size,
                    in_stock: filtered.some(variant => variant.size === v.size && variant.in_stock)
                }));
            },

            selectColor(color) {
                this.selectedColor = color;
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
    function increment() {
        const input = document.getElementById('quantity');
        input.value = parseInt(input.value || '1') + 1;
    }

    function decrement() {
        const input = document.getElementById('quantity');
        const current = parseInt(input.value || '1');
        if (current > 1) {
            input.value = current - 1;
        }
    }
</script>
@endsection