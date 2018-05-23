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
            $table->string('store_name',30);
            $table->string('local',10)->nullable()->comment('郵遞區號');
            $table->string('address',150)->nullable()->comment('地址');
            $table->time('open_time')->nullable()->comment('開始時間');
            $table->time('close_time')->nullable()->comment('結束時間');
            $table->string('telephone',30)->nullable()->comment('電話號碼');
            $table->tinyInteger('is_hidden')->default(0)->unsigned()->index()->comment('是否隐藏');
            $table->tinyInteger('status')->index()->default(1)->comment('状态: 1 正常, 2=>禁止');
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
