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
        Schema::create('categories', function (Blueprint $table) {
             $table->id();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->string('name');

            $table->string('slug')->unique();

            $table->string('image', 1000)->nullable();
            $table->text('description')->nullable();

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->boolean('show_in_menu')
                ->default(true);

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->index('parent_id');
            $table->index('sort_order');
            $table->index('show_in_menu');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
