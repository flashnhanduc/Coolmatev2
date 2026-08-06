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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Có thể NULL nếu tài khoản người đánh giá bị xóa
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Dùng để xác minh khách đã mua sản phẩm
            $table->foreignId('order_item_id')
                ->nullable()
                ->constrained('order_items')
                ->nullOnDelete();

            // Điểm đánh giá từ 1 đến 5
            $table->unsignedTinyInteger('rating');

            $table->string('title')
                ->nullable();

            $table->text('content')
                ->nullable();

            // Xác định đánh giá đến từ khách đã mua hàng
            $table->boolean('is_verified_purchase')
                ->default(false);

            // Tổng số người thấy đánh giá hữu ích
            $table->unsignedInteger('helpful_count')
                ->default(0);

            // pending, published, hidden hoặc rejected
            $table->string('status', 30)
                ->default('pending');

            $table->timestamp('published_at')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Một sản phẩm trong đơn chỉ được đánh giá một lần
            $table->unique('order_item_id');

            $table->index([
                'product_id',
                'status',
                'published_at',
            ]);

            $table->index([
                'user_id',
                'created_at',
            ]);

            $table->index([
                'product_id',
                'rating',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
