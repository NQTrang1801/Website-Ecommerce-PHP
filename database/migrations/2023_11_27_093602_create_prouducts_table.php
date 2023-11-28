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
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->string('detail')->nullable();
            $table->string('care')->nullable();
            $table->integer("price");
            $table->integer("amount")->default(0);
            $table->integer('status')->default(1);
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict')->nullable();;
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('restrict')->nullable();
            $table->foreignId('promotion_id')->constrained('promotion')->onDelete('restrict')->nullable();
            $table->foreignId('images_id')->constrained('products_images')->onDelete('restrict')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prouducts');
    }
};
