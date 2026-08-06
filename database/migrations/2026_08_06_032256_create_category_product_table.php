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
        Schema::create('category_product', function (Blueprint $table) {
             // Reference to the assigned category
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            // Reference to the assigned product
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Controls the product display order within a category
            $table->unsignedInteger('sort_order')
                ->default(0);

            // Prevents assigning the same product to a category more than once
            $table->primary([
                'category_id',
                'product_id',
            ]);

            // Improves product sorting performance within each category
            $table->index([
                'category_id',
                'sort_order',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};
