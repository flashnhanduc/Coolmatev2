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
        Schema::create('recently_viewed_products', function (Blueprint $table) {
            $table->id();
             // Có giá trị khi khách đã đăng nhập
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            // Có giá trị khi khách chưa đăng nhập
            $table->string('session_token', 120)
                ->nullable();

            // Khóa chung để nhận diện cả user và khách vãng lai
            $table->string('visitor_key', 150);

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->timestamp('viewed_at')
                ->useCurrent();

            // Một khách chỉ có một dòng lịch sử cho mỗi sản phẩm
            $table->unique(
                [
                    'visitor_key',
                    'product_id',
                ],
                'visitor_product_unique'
            );

            $table->index([
                'user_id',
                'viewed_at',
            ]);

            $table->index([
                'session_token',
                'viewed_at',
            ]);

            $table->index([
                'product_id',
                'viewed_at',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recently_viewed_products');
    }
};
