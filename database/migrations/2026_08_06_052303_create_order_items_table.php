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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            // Cho phép NULL để giữ lịch sử nếu sản phẩm bị xóa hoàn toàn
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->foreignId('product_variant_id')
                ->nullable()
                ->constrained('product_variants')
                ->nullOnDelete();

            // Thông tin sản phẩm được chụp lại tại thời điểm đặt hàng
            $table->string('product_name_snapshot');
            $table->string('sku_snapshot', 100);

            // Lưu màu, size và các thuộc tính của variant lúc mua
            $table->json('variant_snapshot');

            $table->string('image_snapshot', 1000)
                ->nullable();

            // Giá của một sản phẩm trước giảm giá
            $table->unsignedBigInteger('unit_price');

            // Tổng số tiền giảm cho dòng sản phẩm này
            $table->unsignedBigInteger('discount_amount')
                ->default(0);

            $table->unsignedInteger('quantity');

            // Tổng tiền cuối cùng của dòng sản phẩm
            $table->unsignedBigInteger('line_total');

            $table->timestamps();

            $table->index([
                'order_id',
                'product_id',
            ]);

            $table->index('sku_snapshot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
