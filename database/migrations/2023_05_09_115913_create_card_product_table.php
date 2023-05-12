<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardProductTable extends Migration
{
    public function up()
    {
        Schema::create('card_product', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('card_id')->constrained();
            $table->foreignId('product_id')->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('card_product');
    }
}
