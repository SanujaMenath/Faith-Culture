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
             $table->string('sku', 100)->unique()->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->decimal('price', 8, 2)->nullable();
            $table->string('image_url', 191)->nullable();
            $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
