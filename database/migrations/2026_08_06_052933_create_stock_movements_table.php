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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            // Không cho xóa cứng SKU đã phát sinh lịch sử tồn kho
            $table->foreignId('product_variant_id')
                ->constrained('product_variants')
                ->restrictOnDelete();

            // Có thể NULL với nghiệp vụ nhập kho hoặc điều chỉnh thủ công
            $table->foreignId('order_id')
                ->nullable()
                ->constrained('orders')
                ->restrictOnDelete();

            // Người thực hiện điều chỉnh tồn kho
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // import, reserve, release, sale, return hoặc adjustment
            $table->string('type', 30);

            // Số lượng tồn vật lý thay đổi, có thể là số âm hoặc dương
            $table->integer('stock_change')
                ->default(0);

            // Số lượng đang giữ thay đổi, có thể là số âm hoặc dương
            $table->integer('reserved_change')
                ->default(0);

            // Tồn vật lý sau khi thực hiện thay đổi
            $table->unsignedInteger('stock_after');

            // Số lượng đang giữ sau khi thực hiện thay đổi
            $table->unsignedInteger('reserved_after');

            // Mã tham chiếu như phiếu nhập kho hoặc mã giao dịch
            $table->string('reference')
                ->nullable();

            $table->text('note')
                ->nullable();

            // Lịch sử tồn kho chỉ được tạo, không nên chỉnh sửa
            $table->timestamp('created_at')
                ->useCurrent();

            $table->index([
                'product_variant_id',
                'created_at',
            ]);

            $table->index([
                'order_id',
                'type',
            ]);

            $table->index('reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
