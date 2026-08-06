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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Ví dụ: Nhà riêng, Công ty
            $table->string('label', 50)->nullable();

            $table->string('recipient_name');
            $table->string('phone', 20);
            $table->string('province_code', 20);
            $table->string('district_code', 20);
            $table->string('ward_code', 20);
            // Số nhà, tên đường
            $table->string('address_line', 500);
            $table->boolean('is_default')
                ->default(false);
            $table->timestamps();
            $table->index('province_code');
            $table->index([
                'user_id',
                'is_default',
            ]);
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
