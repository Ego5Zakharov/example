<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCard;
use App\Models\Role;
use App\Models\RoleUser;
use Database\Factories\ProductFactory;
use Database\Factories\RoleUserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
//        if (Product::query()->count() > 1) {
//            Product::factory(10)->create();
//        }
//        if (ProductCard::query()->count() > 1) {
//            ProductCard::factory(10)->create();
//        }

        if (Role::query()->count() === 0) {
            Role::query()->create(['name' => 'admin']);
            Role::query()->create(['name' => 'editor']);
            Role::query()->create(['name' => 'moderator']);
            Role::query()->create(['name' => 'user']);
        }

        if (RoleUser::query()->count() === 0) {
            RoleUser::factory(3)->create();
        }
    }
}
