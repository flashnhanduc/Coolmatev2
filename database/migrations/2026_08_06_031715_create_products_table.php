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
            $table->foreignId('primary_category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            $table->foreignId('size_guide_id')
                ->nullable()
                ->constrained('size_guides')
                ->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            // Mã mẫu sản phẩm, không phải mã SKU
            $table->string('product_code', 80)->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('material')->nullable();
            $table->string('fit')->nullable();
            $table->text('care_instructions')->nullable();
            $table->string('origin')->nullable();
            // men, women, unisex, kids
            $table->string('audience', 30)
                ->default('unisex')
                ->index();
            $table->string('status', 30)
                ->default('draft')
                ->index();
            $table->boolean('is_featured')
                ->default(false)
                ->index();
            $table->decimal('rating_average', 3, 2)
                ->default(0);
            $table->unsignedInteger('reviews_count')
                ->default(0);
            $table->unsignedInteger('sold_count')
                ->default(0);
            $table->timestamp('published_at')
                ->nullable()
                ->index();

            $table->timestamps();
            $table->softDeletes();
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
