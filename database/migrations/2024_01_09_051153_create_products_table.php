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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('stock');
            $table->decimal('price', 10);
            // $table->enum('type', ['Male', 'Female', 'Unisex'])->nullable();
            $table->unsignedBigInteger('supplierId')->nullable();
            $table->foreign('supplierId')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('categoryId')->nullable();
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('typeId')->nullable();
            $table->foreign('typeId')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
