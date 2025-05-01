<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

   

    public function run()
    {
        Product::create([
            'name' => 'Classic T-Shirt',
            'description' => 'Comfortable cotton T-shirt in various sizes',
            'price' => 19.99,
            'image_url' => 'https://via.placeholder.com/300x200'
        ]);

        Product::create([
            'name' => 'Slim Fit Jeans',
            'description' => 'Trendy slim fit jeans for all occasions',
            'price' => 39.99,
            'image_url' => 'https://via.placeholder.com/300x200'
        ]);
    }


}
