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
        Schema::create('homepage_sections', function (Blueprint $table) {
            $table->id();
           // Mã duy nhất để frontend nhận biết khu vực
            $table->string('section_key', 100)
                ->unique();

            // Loại khu vực: banner, collection, products hoặc content
            $table->string('type', 50);

            // Banner được sử dụng nếu khu vực có type là banner
            $table->foreignId('banner_id')
                ->nullable()
                ->constrained('banners')
                ->nullOnDelete();

            // Bộ sưu tập được sử dụng nếu type là collection
            $table->foreignId('collection_id')
                ->nullable()
                ->constrained('collections')
                ->nullOnDelete();

            $table->string('title')
                ->nullable();

            $table->text('subtitle')
                ->nullable();

            // Lưu cấu hình hiển thị mở rộng của khu vực
            $table->json('settings')
                ->nullable();

            // Thứ tự xuất hiện của khu vực trên trang chủ
            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->index([
                'is_active',
                'sort_order',
            ]);

            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_sections');
    }
};
