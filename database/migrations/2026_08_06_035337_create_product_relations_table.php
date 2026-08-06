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
        Schema::create('product_relations', function (Blueprint $table) {
            $table->id();
            // Sản phẩm đang được xem
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Sản phẩm được đề xuất
            $table->foreignId('related_product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Loại quan hệ: related, cross_sell hoặc frequently_bought_together
            $table->string('relation_type', 50)
                ->default('related');

            // Thứ tự hiển thị sản phẩm được đề xuất
            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            // Không cho phép tạo trùng một quan hệ sản phẩm
            $table->unique(
                [
                    'product_id',
                    'related_product_id',
                    'relation_type',
                ],
                'product_relation_unique'
            );

            $table->index([
                'product_id',
                'relation_type',
                'sort_order',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_relations');
    }
};
