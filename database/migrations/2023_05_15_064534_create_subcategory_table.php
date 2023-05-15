<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoryTable extends Migration
{
    public function up()
    {
        Schema::create('subcategory', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->boolean('active')->default(1);

            $table->foreignId('category_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subcategory');
    }
}
