<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');

            // FK ke supplier_types (UUID)
            $table->char('supplier_type_id', 36)->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();

            $table->char('district_id', 7)
                ->nullable()
                ->collation('utf8_unicode_ci');

            $table->char('village_id', 10)
                ->nullable()
                ->collation('utf8_unicode_ci');

            // Koordinat lokasi
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Creator (UUID user)
            $table->char('creator_id', 36)->nullable();

            $table->timestamps();

            // Indexes
            $table->index('supplier_type_id');
            $table->index('district_id');
            $table->index('village_id');
            $table->index('creator_id');

            // Foreign Key supplier_type
            $table->foreign('supplier_type_id')
                ->references('id')->on('supplier_types')
                ->cascadeOnDelete();

            $table->foreign('district_id')
                ->references('id')->on('districts')
                ->nullOnDelete();

            $table->foreign('village_id')
                ->references('id')->on('villages')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
