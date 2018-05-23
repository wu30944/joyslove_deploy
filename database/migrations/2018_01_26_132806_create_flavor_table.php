<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlavorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flavor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('flavor_name',30)->comment('口味名稱');
            $table->integer('money')->comment('價格');
            $table->text('material')->nullable()->comment('材料');
            $table->tinyInteger('status')->index()->default(1)->comment('狀態: 1 正常, 2 禁止');
            $table->string('para_1',50)->nullable();
            $table->string('para_2',50)->nullable();
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
        Schema::dropIfExists('flavor');
    }
}
