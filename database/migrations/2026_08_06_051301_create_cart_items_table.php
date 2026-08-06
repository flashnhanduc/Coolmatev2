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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')
                ->constrained('carts')
                ->cascadeOnDelete();

            // SKU mà khách đã chọn màu và kích thước
            $table->foreignId('product_variant_id')
                ->constrained('product_variants')
                ->restrictOnDelete();

            $table->unsignedInteger('quantity')
                ->default(1);

            // Giá tại thời điểm sản phẩm được thêm vào giỏ
            $table->unsignedBigInteger('unit_price_snapshot');

            // Số tiền giảm tạm tính của một đơn vị sản phẩm
            $table->unsignedBigInteger('discount_snapshot')
                ->default(0);

            // Xác định sản phẩm có được chọn để checkout hay không
            $table->boolean('is_selected')
                ->default(true);

            $table->timestamps();

            // Một SKU chỉ xuất hiện một lần trong cùng giỏ hàng
            $table->unique(
                [
                    'cart_id',
                    'product_variant_id',
                ],
                'cart_variant_unique'
            );

            $table->index([
                'cart_id',
                'is_selected',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
