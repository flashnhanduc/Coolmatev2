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
        Schema::create('product_content_sections', function (Blueprint $table) {
            $table->id();
             $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Tiêu đề của phần nội dung hoặc accordion
            $table->string('title');

            // Nội dung HTML được nhập từ trình soạn thảo
            $table->longText('content');

            // Ảnh minh họa cho phần nội dung
            $table->string('image', 1000)
                ->nullable();

            // Thứ tự hiển thị các phần nội dung
            $table->unsignedInteger('sort_order')
                ->default(0);

            // Xác định phần nội dung có được mở sẵn hay không
            $table->boolean('open_by_default')
                ->default(false);

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
        Schema::dropIfExists('product_content_sections');
    }
};
