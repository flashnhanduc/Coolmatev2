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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
             $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Có thể gắn ảnh cho một biến thể cụ thể
            $table->foreignId('product_variant_id')
                ->nullable()
                ->constrained('product_variants')
                ->nullOnDelete();

            // Có thể gắn ảnh chung cho một màu sản phẩm
            $table->foreignId('color_id')
                ->nullable()
                ->constrained('colors')
                ->nullOnDelete();

            // Đường dẫn hoặc URL của ảnh
            $table->string('path', 1000);

            // Nội dung mô tả ảnh, hỗ trợ SEO và accessibility
            $table->string('alt_text')->nullable();

            // Xác định đây có phải ảnh đại diện hay không
            $table->boolean('is_primary')
                ->default(false);

            // Thứ tự hiển thị trong album ảnh
            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index([
                'product_id',
                'is_primary',
            ]);

            $table->index([
                'product_id',
                'color_id',
                'sort_order',
            ]);

            $table->index('product_variant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
