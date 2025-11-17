<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pejabat_strukturals', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('nama');
            $table->uuid('jabatan_id'); // FK UUID konsisten
            $table->string('nip')->nullable();
            $table->string('foto')->nullable();
            $table->text('biografi')->nullable();
            $table->timestamps();

            $table->foreign('jabatan_id')
                ->references('id')
                ->on('jabatans')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabat_strukturals');
    }
};
