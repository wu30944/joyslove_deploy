<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systemcode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_type','5')->comment('類型');
            $table->string('code_id','5')->comment('類型id');
            $table->string('zh_code_val','50')->nullable()->comment('中文名稱');
            $table->string('en_code_val','50')->nullable()->comment('英文名稱');
            $table->string('para_1','50')->nullable()->comment('參數1');
            $table->string('para_2','50')->nullable()->comment('參數2');
            $table->string('para_3','50')->nullable()->comment('參數3');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('systemcode');
    }
}
