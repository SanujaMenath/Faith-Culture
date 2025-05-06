<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('color', 50);
            $table->string('size', 10);
            $table->string('sku', 100)->nullable()->unique();
            $table->integer('stock_quantity')->default(0);
            $table->decimal('price', 8, 2)->nullable(); // Variant-specific price
            $table->string('image_url', 191)->nullable(); // Optional variant image
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
