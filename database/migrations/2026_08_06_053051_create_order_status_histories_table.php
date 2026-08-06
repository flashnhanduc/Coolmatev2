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
        Schema::create('order_status_histories', function (Blueprint $table) {
            $table->id();
            // Không cho xóa cứng đơn hàng đã có lịch sử
            $table->foreignId('order_id')
                ->constrained('orders')
                ->restrictOnDelete();

            // Loại trạng thái: order, payment hoặc fulfillment
            $table->string('status_type', 30)
                ->default('order');

            // Trạng thái trước khi thay đổi
            $table->string('from_status', 30)
                ->nullable();

            // Trạng thái sau khi thay đổi
            $table->string('to_status', 30);

            $table->text('note')
                ->nullable();

            // Người thực hiện thay đổi, NULL nếu hệ thống tự động cập nhật
            $table->foreignId('changed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Lịch sử chỉ được tạo mới, không nên chỉnh sửa
            $table->timestamp('created_at')
                ->useCurrent();

            $table->index([
                'order_id',
                'created_at',
            ]);

            $table->index([
                'status_type',
                'to_status',
            ]);

            $table->index('changed_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status_histories');
    }
};
