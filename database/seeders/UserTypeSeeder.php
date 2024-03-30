<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::insert([
            [
                'name' => 'Admin',
                'description' => 'This is an admin user, responsible for managing the system.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Customer',
                'description' => 'This is the client user, responsible for adopting the pets through the mobile application.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ONG',
                'description' => 'This is the ONG user, responsible for registering the animals in the system and making them available for adoption.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
