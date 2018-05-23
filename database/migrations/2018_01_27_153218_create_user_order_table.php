<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_serial_no')->comment('訂單當日序號');
            $table->integer('flavor_id')->comment('產品編號');
            $table->text('flavor_name')->comment('產品名稱');
            $table->integer('order_num')->comment('訂購數量');
            $table->integer('money')->comment('總價');
            $table->tinyInteger('status')->index()->default(2)->comment('狀態: 1 完成, 2 未完成');
            $table->date('order_date')->comment('訂單日期');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_order');
    }
}
