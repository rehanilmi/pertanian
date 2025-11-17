<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pengumumans', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->date('tanggal');
            $table->string('judul');
            $table->text('isi')->nullable();

            $table->uuid('bidang_id')->nullable();  // FK ke bidangs.id

            $table->string('status', 10)->default('unpublish');

            $table->timestamps();

            $table->foreign('bidang_id')
                ->references('id')
                ->on('bidangs')
                ->nullOnDelete();
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};
