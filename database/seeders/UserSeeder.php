<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Quản trị viên',
                'email' => 'admin@coolmate.test',
                'phone' => '0900000001',
                'password' => '12345678',
                'birthday' => '2000-01-01',
                'gender' => 'malemale',
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'Nguyễn Văn An',
                'email' => 'customer@coolmate.test',
                'phone' => '0900000002',
                'password' => '12345678',
                'birthday' => '2002-05-20',
                'gender' => 'male',
                'role' => 'customer',
                'status' => 'active',
            ],
            [
                'name' => 'Trần Ngọc Mai',
                'email' => 'mai@coolmate.test',
                'phone' => '0900000003',
                'password' => '12345678',
                'birthday' => '2003-08-15',
                'gender' => 'female',
                'role' => 'customer',
                'status' => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            $user->forceFill([
                'email_verified_at' => now(),
            ])->save();
        }
    }
}