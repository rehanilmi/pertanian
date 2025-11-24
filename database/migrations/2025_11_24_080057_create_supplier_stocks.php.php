<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplier_stocks', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Relasi Supplier
            $table->char('supplier_id', 36);
            $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
                ->cascadeOnDelete();

            // Relasi Varietas Benih
            $table->char('variety_id', 36);
            $table->foreign('variety_id')
                ->references('id')->on('seed_varieties')
                ->cascadeOnDelete();

            // Informasi Stok
            $table->integer('quantity')->default(0); // jumlah kg
            $table->string('unit')->default('kg');   // satuan
            $table->integer('price')->nullable();    // opsional
            $table->date('stock_date')->nullable();  // tanggal stok masuk

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplier_stocks');
    }
};
