<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumDTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_d', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('album_id');
            $table->string('photo_name',120);
            $table->string('photo_path',600);
            $table->string('photo_thumb_path',600);
            $table->string('photo_virtual_path',600);
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
        Schema::dropIfExists('album_d');
    }
}


//CREATE TABLE `album_d` (
//`id` int(10) UNSIGNED NOT NULL,
//  `album_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
//  `photo_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
//  `photo_path` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
//  `photo_thumb_path` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
//  `photo_virtual_path` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
//  `created_at` timestamp NULL DEFAULT NULL,
//  `updated_at` timestamp NULL DEFAULT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;