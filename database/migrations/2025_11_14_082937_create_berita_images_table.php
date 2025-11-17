<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaImagesTable extends Migration
{
    public function up()
    {
        Schema::create('berita_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('berita_id');
            $table->string('gambar');
            $table->timestamps();

            $table->foreign('berita_id')
                ->references('id')->on('beritas')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('berita_images');
    }
}
