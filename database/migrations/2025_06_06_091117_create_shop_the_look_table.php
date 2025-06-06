<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_the_look', function (Blueprint $table) {
            $table->id();
            $table->string('model_image')->nullable();
            $table->string('top_image')->nullable();
            $table->string('top_product_link')->nullable();
            $table->string('trouser_image')->nullable();
            $table->string('trouser_product_link')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_the_look');
    }
};
