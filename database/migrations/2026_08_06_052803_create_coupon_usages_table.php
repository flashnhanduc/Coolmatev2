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
        Schema::create('coupon_usages', function (Blueprint $table) {
            $table->id();
           
            // Không cho xóa coupon đã từng được sử dụng
            $table->foreignId('coupon_id')
                ->constrained('coupons')
                ->restrictOnDelete();

            // Có thể NULL nếu khách đặt hàng mà chưa đăng nhập
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Không cho xóa cứng đơn hàng đã sử dụng coupon
            $table->foreignId('order_id')
                ->constrained('orders')
                ->restrictOnDelete();

            // Số tiền thực tế coupon đã giảm cho đơn hàng
            $table->unsignedBigInteger('discount_amount');

            $table->timestamp('used_at')
                ->useCurrent();

            $table->timestamps();

            // Mỗi đơn hàng chỉ được ghi nhận một lần sử dụng coupon
            $table->unique('order_id');

            $table->index([
                'coupon_id',
                'user_id',
            ]);

            $table->index([
                'coupon_id',
                'used_at',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_usages');
    }
};
