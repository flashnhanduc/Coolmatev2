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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
           
            // Không cho xóa cứng đơn hàng đã có vận đơn
            $table->foreignId('order_id')
                ->constrained('orders')
                ->restrictOnDelete();

            // Tên đơn vị vận chuyển
            $table->string('carrier', 100)
                ->nullable();

            // Mã vận đơn do đơn vị vận chuyển cung cấp
            $table->string('tracking_number', 120)
                ->nullable()
                ->unique();

            // pending, ready, shipped, delivering, delivered, failed hoặc returned
            $table->string('status', 30)
                ->default('pending');

            // Phí thực tế trả cho đơn vị vận chuyển
            $table->unsignedBigInteger('fee')
                ->nullable();

            // Lưu dữ liệu theo dõi cần thiết từ đơn vị vận chuyển
            $table->json('tracking_payload')
                ->nullable();

            $table->timestamp('shipped_at')
                ->nullable();

            $table->timestamp('delivered_at')
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
        Schema::dropIfExists('shipments');
    }
};
