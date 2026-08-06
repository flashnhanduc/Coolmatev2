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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
             $table->string('name');

            // Loại giảm giá: percent, fixed hoặc tiered
            $table->string('promotion_type', 30);

            // Nội dung hiển thị trên giao diện
            $table->string('label')
                ->nullable();

            // Giá trị giảm, được hiểu dựa vào promotion_type
            $table->decimal('discount_value', 15, 2)
                ->nullable();

            // Giá trị đơn hàng tối thiểu để áp dụng
            $table->unsignedBigInteger('minimum_order_amount')
                ->nullable();

            // Số tiền giảm tối đa, chủ yếu dùng cho giảm theo phần trăm
            $table->unsignedBigInteger('maximum_discount')
                ->nullable();

            // Cho phép sử dụng cùng coupon hoặc khuyến mãi khác
            $table->boolean('is_stackable')
                ->default(false);

            // Lưu các điều kiện mở rộng của chương trình
            $table->json('rules')
                ->nullable();

            // Trạng thái: draft, active, paused hoặc expired
            $table->string('status', 30)
                ->default('draft');

            $table->timestamp('starts_at')
                ->nullable();

            $table->timestamp('ends_at')
                ->nullable();

            $table->timestamps();

            $table->index([
                'status',
                'starts_at',
                'ends_at',
            ]);

            $table->index('promotion_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
