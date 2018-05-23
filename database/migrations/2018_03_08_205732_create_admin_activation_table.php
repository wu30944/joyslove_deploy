<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminActivationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_activation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token')->unique();
            $table->boolean('active')->default(0);
            $table->string('name',32)->comment('用户名');
            $table->timestamps();
//            $table->foreign('name')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_activation');
    }
}
