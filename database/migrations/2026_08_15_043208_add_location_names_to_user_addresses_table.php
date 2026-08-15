<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'user_addresses',
            function (Blueprint $table) {
                $table->string('province_name')
                    ->nullable()
                    ->after('province_code');

                $table->string('district_name')
                    ->nullable()
                    ->after('district_code');

                $table->string('ward_name')
                    ->nullable()
                    ->after('ward_code');
            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'user_addresses',
            function (Blueprint $table) {
                $table->dropColumn([
                    'province_name',
                    'district_name',
                    'ward_name',
                ]);
            }
        );
    }
};