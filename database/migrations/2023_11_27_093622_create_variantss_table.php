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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('size')->onDelete('restrict')->nullable();
            $table->foreignId('color_id')->constrained('color')->onDelete('restrict')->nullable();
            $table->foreignId('promotion_id')->constrained('promotion')->onDelete('restrict')->nullable();
            $table->string('image')->nullable();
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();

            $table->unique(['color_id', 'size_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
