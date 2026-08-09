<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)
                ->nullable()
                ->unique()
                ->after('email');

            $table->date('birthday')
                ->nullable()
                ->after('phone');

            $table->string('gender', 20)
                ->nullable()
                ->after('birthday');

            // customer, staff, admin
            $table->string('role', 30)
                ->default('customer')
                ->index()
                ->after('gender');

            // active, blocked
            $table->string('status', 30)
                ->default('active')
                ->index()
                ->after('role');
        });
    }

    /**
     * Xóa những cột thông tin hồ sơ.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['phone']);
            $table->dropIndex(['role']);
            $table->dropIndex(['status']);

            $table->dropColumn([
                'phone',
                'birthday',
                'gender',
                'role',
                'status',
            ]);
        });
    }
};
