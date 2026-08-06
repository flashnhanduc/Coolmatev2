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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
             $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->foreignId('color_id')
                ->constrained('colors')
                ->restrictOnDelete();

            $table->foreignId('size_id')
                ->constrained('sizes')
                ->restrictOnDelete();

            // Unique stock keeping unit for each product variant
            $table->string('sku', 100)->unique();

            $table->string('barcode', 100)
                ->nullable()
                ->unique();

            // Monetary values are stored as integer VND amounts
            $table->unsignedBigInteger('price');

            $table->unsignedBigInteger('compare_at_price')
                ->nullable();

            $table->unsignedBigInteger('cost_price')
                ->nullable();

            $table->unsignedInteger('stock_quantity')
                ->default(0);

            // Quantity temporarily reserved during checkout
            $table->unsignedInteger('reserved_quantity')
                ->default(0);

            $table->unsignedInteger('low_stock_threshold')
                ->default(5);

            $table->unsignedInteger('weight_grams')
                ->nullable();

            $table->string('status', 30)
                ->default('active');

            $table->timestamps();
            $table->softDeletes();

            // Prevents duplicate color-size combinations within a product
            $table->unique(
                ['product_id', 'color_id', 'size_id'],
                'product_color_size_unique'
            );

            $table->index([
                'product_id',
                'status',
            ]);

            $table->index('stock_quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
