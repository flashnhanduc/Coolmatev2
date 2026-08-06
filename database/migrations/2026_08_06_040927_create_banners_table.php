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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            // Tên nội bộ để quản trị viên nhận biết banner
            $table->string('name');

            // Vị trí hiển thị: home_hero, home_middle, menu hoặc product
            $table->string('location', 50);

            $table->string('title')
                ->nullable();

            $table->text('subtitle')
                ->nullable();

            // Ảnh sử dụng trên màn hình máy tính
            $table->string('image_desktop', 1000);

            // Ảnh tối ưu riêng cho điện thoại
            $table->string('image_mobile', 1000)
                ->nullable();

            $table->string('button_text', 100)
                ->nullable();

            // Đường dẫn khi khách nhấn vào banner
            $table->string('link', 1000)
                ->nullable();

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->boolean('is_active')
                ->default(true);

            // Khoảng thời gian banner được phép hiển thị
            $table->timestamp('starts_at')
                ->nullable();

            $table->timestamp('ends_at')
                ->nullable();

            $table->timestamps();

            $table->index([
                'location',
                'is_active',
                'sort_order',
            ]);

            $table->index([
                'starts_at',
                'ends_at',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
