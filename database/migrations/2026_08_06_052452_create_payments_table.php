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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
             // Không cho xóa cứng đơn hàng đã có giao dịch thanh toán
            $table->foreignId('order_id')
                ->constrained('orders')
                ->restrictOnDelete();

            $table->foreignId('payment_method_id')
                ->constrained('payment_methods')
                ->restrictOnDelete();

            // Mã giao dịch do MoMo, VNPAY hoặc nhà cung cấp trả về
            $table->string('provider_transaction_id')
                ->nullable()
                ->unique();

            $table->unsignedBigInteger('amount');

            // pending, paid, failed, cancelled hoặc refunded
            $table->string('status', 30)
                ->default('pending');

            // Lưu phản hồi cần thiết từ cổng thanh toán
            $table->json('provider_payload')
                ->nullable();

            $table->text('failure_reason')
                ->nullable();

            $table->timestamp('paid_at')
                ->nullable();

            $table->timestamp('failed_at')
                ->nullable();

            $table->timestamps();

            $table->index([
                'order_id',
                'status',
            ]);

            $table->index([
                'status',
                'created_at',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
