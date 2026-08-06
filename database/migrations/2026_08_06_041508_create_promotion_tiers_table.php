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
        Schema::create('promotion_tiers', function (Blueprint $table) {
            $table->id();
             $table->foreignId('promotion_id')
        ->constrained('promotions')
        ->cascadeOnDelete();

    // Số lượng sản phẩm tối thiểu để đạt mức giảm này
    $table->unsignedInteger('minimum_quantity');

    // Loại giảm giá của mức: percent hoặc fixed
    $table->string('discount_type', 30);

    // Giá trị giảm tương ứng với discount_type
    $table->decimal('discount_value', 15, 2);

    $table->timestamps();

    // Một chương trình không được có hai mức cùng số lượng
    $table->unique(
        [
            'promotion_id',
            'minimum_quantity',
        ],
        'promotion_quantity_unique'
    );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_tiers');
    }
};
