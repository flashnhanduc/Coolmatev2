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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
             // Human-readable size name
            $table->string('name', 50);

            // Unique size code used internally by the application
            $table->string('code', 30)->unique();

            // Controls the size display order
            $table->unsignedInteger('sort_order')
                ->default(0);

            // Determines whether the size is available for selection
            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            // Improves active size filtering and sorting performance
            $table->index([
                'is_active',
                'sort_order',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
