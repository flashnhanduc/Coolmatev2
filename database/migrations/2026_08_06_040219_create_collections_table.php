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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
           $table->string('name');

            // Đường dẫn thân thiện của bộ sưu tập
            $table->string('slug')->unique();

            $table->text('description')
                ->nullable();

            // Ảnh đại diện hoặc ảnh bìa bộ sưu tập
            $table->string('cover_image', 1000)
                ->nullable();

            // Trạng thái: draft, active hoặc inactive
            $table->string('status', 30)
                ->default('draft');

            // Thời điểm bắt đầu hiển thị bộ sưu tập
            $table->timestamp('starts_at')
                ->nullable();

            // Thời điểm kết thúc hiển thị bộ sưu tập
            $table->timestamp('ends_at')
                ->nullable();

            $table->timestamps();

            $table->index([
                'status',
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
        Schema::dropIfExists('collections');
    }
};
