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
        Schema::create('product_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Tên đặc điểm nổi bật
            $table->string('name');

            // Đường dẫn ảnh hoặc biểu tượng của đặc điểm
            $table->string('icon', 1000)
                ->nullable();

            // Nội dung giải thích chi tiết
            $table->text('description')
                ->nullable();

            // Thứ tự hiển thị đặc điểm trên trang sản phẩm
            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index([
                'product_id',
                'sort_order',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_features');
    }
};
