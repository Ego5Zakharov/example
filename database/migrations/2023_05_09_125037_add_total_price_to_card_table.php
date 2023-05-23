<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalPriceToCardTable extends Migration
{

//            Цифры 10 и 2 в этом случае указывают формат числа, который будет храниться в столбце total_price.
//            Они определяют, что в этом столбце будет храниться число с 10 цифрами,
//            из которых две будут отведены для хранения дробной части
//            (то есть, общее количество знаков до и после десятичной точки будет 10 и 2 соответственно).
//            Это означает, что в столбце total_price можно хранить денежные значения с доходящей до сотых копеек точностью.

    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->decimal('total_price', 10, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn('total_price');
        });
    }
}
