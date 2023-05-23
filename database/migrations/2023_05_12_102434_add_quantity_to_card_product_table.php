<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityToCardProductTable extends Migration
{
    public function up()
    {
        Schema::table('card_product', function (Blueprint $table) {
            $table->integer('quantity')->default(0);
            $table->decimal('total_price')->default(0);
        });
    }

    public function down()
    {
        Schema::table('card_product', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
}
