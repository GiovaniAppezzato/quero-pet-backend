<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\UserTypeEnum;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'root@gmail.com',
            'password' => Hash::make('root'),
            'user_type_id' => UserTypeEnum::ADMIN->value,
        ])
            ->admin()
            ->create([
                'first_name' => 'User',
                'last_name' => 'Root',
                'created_by' => null,
            ]);
    }
}
