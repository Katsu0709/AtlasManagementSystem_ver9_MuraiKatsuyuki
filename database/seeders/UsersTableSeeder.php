<?php

namespace Database\Seeders;

use App\Models\Users\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'over_name' => 'テスト',       // 姓
            'under_name' => '太郎',      // 名
            'over_name_kana' => 'テスト',  // セイ
            'under_name_kana' => 'タロウ', // メイ
            'mail_address' => 'test@example.com',
            'password' => \Hash::make('password123'),
            'birth_day' => '1995-01-01',
            'sex' => 1,
            'role' => 4,
        ]);
    }
}
