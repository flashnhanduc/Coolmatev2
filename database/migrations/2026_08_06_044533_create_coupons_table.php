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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            
            // Mã khách hàng nhập khi checkout
            $table->string('code', 80)
                ->unique();

            $table->string('name');

            $table->text('description')
                ->nullable();

            // Loại giảm giá: percent hoặc fixed
            $table->string('discount_type', 30);

            // Giá trị giảm tương ứng với discount_type
            $table->decimal('discount_value', 15, 2);

            // Giá trị đơn hàng tối thiểu để sử dụng coupon
            $table->unsignedBigInteger('minimum_order_amount')
                ->nullable();

            // Số tiền được giảm tối đa
            $table->unsignedBigInteger('maximum_discount')
                ->nullable();

            // Tổng số lần coupon được phép sử dụng
            $table->unsignedInteger('usage_limit')
                ->nullable();

            // Tổng số lần coupon đã được sử dụng
            $table->unsignedInteger('used_count')
                ->default(0);

            // Số lần tối đa mỗi người dùng được sử dụng
            $table->unsignedInteger('per_user_limit')
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

            $table->index('discount_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
