<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_name')->comment('分店名稱');
            $table->string('manager')->nullable()->comment('管理人');
            $table->string('address')->nullable()->comment('分店地址');
            $table->string('phone')->nullable()->comment('分店電話');
            $table->string('email')->nullable()->comment('分店email');
            $table->time('open_time')->nullable()->comment('分店營業起時');
            $table->time('close_time')->nullable()->comment('分店營業迄時');
            $table->tinyInteger('status')->index()->default(1)->comment('狀態: 1 正常, 2=>禁止');
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
        Schema::dropIfExists('store_info');
    }
}
