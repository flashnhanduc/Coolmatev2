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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Mã đơn hàng hiển thị cho khách hàng
            $table->string('order_number', 50)
                ->unique();

            // Có thể NULL nếu khách đặt hàng mà chưa đăng nhập
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('coupon_id')
                ->nullable()
                ->constrained('coupons')
                ->nullOnDelete();

            $table->foreignId('shipping_method_id')
                ->nullable()
                ->constrained('shipping_methods')
                ->nullOnDelete();

            $table->foreignId('payment_method_id')
                ->nullable()
                ->constrained('payment_methods')
                ->nullOnDelete();

            // Lưu lại thông tin khách tại thời điểm đặt hàng
            $table->string('customer_name');
            $table->string('customer_email')
                ->nullable();
            $table->string('customer_phone', 20);

            // pending, confirmed, processing, shipping, completed, cancelled
            $table->string('status', 30)
                ->default('pending');

            // unpaid, pending, paid, failed, refunded
            $table->string('payment_status', 30)
                ->default('unpaid');

            // unfulfilled, preparing, shipped, delivered, returned
            $table->string('fulfillment_status', 30)
                ->default('unfulfilled');

            // Tổng tiền sản phẩm trước giảm giá
            $table->unsignedBigInteger('subtotal')
                ->default(0);

            // Tổng giảm giá tự động từ promotions
            $table->unsignedBigInteger('product_discount_total')
                ->default(0);

            // Tổng giảm giá từ coupon
            $table->unsignedBigInteger('coupon_discount_total')
                ->default(0);

            $table->unsignedBigInteger('shipping_fee')
                ->default(0);

            $table->unsignedBigInteger('tax_total')
                ->default(0);

            // Số tiền cuối cùng khách phải thanh toán
            $table->unsignedBigInteger('grand_total')
                ->default(0);

            $table->text('note')
                ->nullable();

            $table->boolean('is_gift')
                ->default(false);

            $table->text('gift_message')
                ->nullable();

            $table->boolean('requires_invoice')
                ->default(false);

            // Thời điểm khách hoàn tất đặt hàng
            $table->timestamp('placed_at')
                ->nullable();

            $table->timestamp('cancelled_at')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'user_id',
                'status',
            ]);

            $table->index([
                'status',
                'placed_at',
            ]);

            $table->index([
                'payment_status',
                'placed_at',
            ]);

            $table->index([
                'fulfillment_status',
                'placed_at',
            ]);

            $table->index('customer_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
