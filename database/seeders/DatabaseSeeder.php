<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCard;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
//        if (Product::query()->count() > 1) {
//            Product::factory(10)->create();
//        }
        if (ProductCard::query()->count() > 1) {
            ProductCard::factory(10)->create();
        }
    }
}
