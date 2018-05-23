<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50)->comment('消息標題');
            $table->date('action_date')->nullable()->comment('活動日期');
            $table->time('action_time')->nullable()->comment('活動時間');
            $table->string('action_position')->nullable()->comment('活動地點');
            $table->string('content')->nullable()->comment('消息內容');
            $table->string('photo',200)->nullable()->comment('消息中照片');
            $table->string('youtube',500)->nullable()->comment('YOUTUBE影片');
            $table->dateTime('show_date')->nullable()->comment('顯示時間');
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
        Schema::dropIfExists('news');
    }
}
