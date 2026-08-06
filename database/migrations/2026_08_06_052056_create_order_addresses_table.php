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
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
             $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            // Loại địa chỉ: shipping hoặc billing
            $table->string('type', 20)
                ->default('shipping');

            $table->string('recipient_name');
            $table->string('phone', 20);

            // Lưu cả mã và tên để bảo toàn dữ liệu đơn hàng
            $table->string('province_code', 20);
            $table->string('province_name');

            $table->string('district_code', 20);
            $table->string('district_name');

            $table->string('ward_code', 20);
            $table->string('ward_name');

            $table->string('address_line', 500);

            $table->timestamps();

            // Mỗi đơn chỉ có tối đa một địa chỉ cho từng loại
            $table->unique(
                [
                    'order_id',
                    'type',
                ],
                'order_address_type_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_addresses');
    }
};
