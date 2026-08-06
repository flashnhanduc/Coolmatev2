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
        Schema::create('wishlist_items', function (Blueprint $table) {
            $table->id();
             $table->foreignId('wishlist_id')
                ->constrained('wishlists')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Lưu màu và size yêu thích nếu người dùng đã chọn
            $table->foreignId('preferred_variant_id')
                ->nullable()
                ->constrained('product_variants')
                ->nullOnDelete();

            $table->timestamps();

            // Một sản phẩm chỉ xuất hiện một lần trong cùng wishlist
            $table->unique(
                [
                    'wishlist_id',
                    'product_id',
                ],
                'wishlist_product_unique'
            );

            $table->index('preferred_variant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist_items');
    }
};
