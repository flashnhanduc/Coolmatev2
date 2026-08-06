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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
           // Có giá trị khi giỏ hàng thuộc về người dùng đã đăng nhập
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Dùng để nhận diện giỏ hàng của khách chưa đăng nhập
            $table->string('session_token', 120)
                ->nullable()
                ->unique();

            // Coupon đang được áp dụng thử cho giỏ hàng
            $table->foreignId('coupon_id')
                ->nullable()
                ->constrained('coupons')
                ->nullOnDelete();

            // Trạng thái: active, converted, abandoned hoặc expired
            $table->string('status', 30)
                ->default('active');

            // Thời điểm hết hạn của giỏ hàng khách
            $table->timestamp('expires_at')
                ->nullable();

            $table->timestamps();

            $table->index([
                'user_id',
                'status',
            ]);

            $table->index([
                'status',
                'expires_at',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
