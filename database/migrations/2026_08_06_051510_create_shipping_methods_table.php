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
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();
           // Mã dùng để xử lý trong hệ thống
            $table->string('code', 50)
                ->unique();

            $table->string('name');

            // Phí vận chuyển cơ bản, tính theo VND
            $table->unsignedBigInteger('base_fee')
                ->default(0);

            // Miễn phí vận chuyển nếu đơn đạt giá trị này
            $table->unsignedBigInteger('free_shipping_threshold')
                ->nullable();

            // Thời gian giao hàng dự kiến, ví dụ: 2-4 ngày
            $table->string('estimated_days', 50)
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index([
                'is_active',
                'sort_order',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};
