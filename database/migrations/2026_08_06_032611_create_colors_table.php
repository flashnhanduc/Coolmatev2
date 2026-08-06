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
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
                        // Human-readable color name
            $table->string('name', 100);

            // URL-friendly and unique color identifier
            $table->string('slug', 100)->unique();

            // CSS hexadecimal color code, for example: #000000
            $table->string('hex_code', 20)->nullable();

            // Optional fabric or texture swatch image
            $table->string('swatch_image', 1000)->nullable();

            // Controls the color display order
            $table->unsignedInteger('sort_order')
                ->default(0);

            // Determines whether the color is available for selection
            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            // Improves color filtering and sorting performance
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
        Schema::dropIfExists('colors');
    }
};
