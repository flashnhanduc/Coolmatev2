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
        Schema::create('collection_product', function (Blueprint $table) {
           $table->foreignId('collection_id')
                ->constrained('collections')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Thứ tự hiển thị sản phẩm trong bộ sưu tập
            $table->unsignedInteger('sort_order')
                ->default(0);

            // Không cho thêm trùng một sản phẩm vào cùng bộ sưu tập
            $table->primary([
                'collection_id',
                'product_id',
            ]);

            $table->index([
                'collection_id',
                'sort_order',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_product');
    }
};
