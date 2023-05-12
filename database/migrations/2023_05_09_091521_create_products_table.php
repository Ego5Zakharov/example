<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('description');
            $table->string('image')->nullable();

            $table->decimal('price');

            $table->timestamp('published_at')->nullable();
            $table->boolean('published')->default(true);

            $table->foreignId('card_id')->nullable()->constrained();

            // category
            // tag
            // brand
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
