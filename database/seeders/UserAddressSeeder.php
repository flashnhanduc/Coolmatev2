<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAddressSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $user = User::query()
                ->where('role', 'customer')
                ->firstOrFail();

            // Đảm bảo người dùng chỉ có một địa chỉ mặc định.
            UserAddress::query()
                ->where('user_id', $user->id)
                ->update([
                    'is_default' => false,
                ]);

            UserAddress::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'address_line' =>
                        '123 đường Võ Văn Ngân',
                ],
                [
                    'recipient_name' => $user->name,
                    'phone' =>
                        $user->phone ?? '0900000002',
                    'province_code' => '79',
                    'province_name' =>
                        'Thành phố Hồ Chí Minh',
                    'district_code' => '769',
                    'district_name' =>
                        'Thành phố Thủ Đức',
                    'ward_code' => '26734',
                    'ward_name' => 'Phường Linh Trung',
                    'is_default' => true,
                ]
            );
        });
    }
}