<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index()->comment('權限名稱');
            $table->string('route',255)->nullable()->comment('權限路由');
            $table->integer('parent_id')->default(0)->unsigned()->index()->comment('上層權限');
            $table->tinyInteger('is_hidden')->default(0)->unsigned()->index()->comment('是否隱藏');
            $table->integer('sort')->default(255)->unsigned()->comment('排序');
            $table->tinyInteger('status')->index()->default(1)->comment('狀態: 1=>正常, 2=>禁止');
            $table->timestamps();
            $table->string('fonts',128)->nullable()->comment('圖示');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navigate');
    }
}
