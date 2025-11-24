<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplier_stock_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('supplier_stock_id', 36);
            $table->foreign('supplier_stock_id')
                ->references('id')
                ->on('supplier_stocks')
                ->cascadeOnDelete();
            $table->enum('change_type', ['IN','OUT']);
            $table->integer('quantity');
            $table->string('note')->nullable();
            $table->char('created_by', 36)->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('supplier_stock_logs');
    }
};
