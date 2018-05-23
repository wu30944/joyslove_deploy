<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->increments('id');
            $table->string('zh_company_name',40)->comment('公司名稱');
            $table->string('en_company_name',40)->nullable()->comment('公司名稱');
            $table->string('address',200)->comment('地址');
            $table->string('fex',30)->nullable()->comment('傳真');
            $table->string('telephone',40)->comment('電話號碼');
            $table->string('email',40)->comment('信箱');
            $table->string('zh_introduction')->comment('公司簡介');
            $table->string('en_introduction')->nullable()->comment('公司簡介');
            $table->string('uniform_number',40)->comment('統一編號');
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
        Schema::dropIfExists('about');
    }
}
