<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_name',10)->comment('菜單名稱');
            $table->string('prod_name',20)->comment('品項名稱');
            $table->string('prod_intro',100)->nullable()->comment('品項介紹');
            $table->string('photo',200)->nullable()->comment('品項照片');
            $table->integer('price')->nullable()->comment('品項價格');
            $table->tinyInteger('status')->index()->default(1)->comment('狀態: 1=>正常, 2=>禁止');
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
        Schema::dropIfExists('menu');
    }
}
