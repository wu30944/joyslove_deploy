<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('album_name','20');
            $table->string('position','50');
            $table->string('status','1');
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
        Schema::dropIfExists('albums');
    }
}

//
//`id` int(10) UNSIGNED NOT NULL,
//  `album_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
//  `position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
//  `isvisible` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
//  `created_at` timestamp NULL DEFAULT NULL,
//  `updated_at` timestamp NULL DEFAULT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;