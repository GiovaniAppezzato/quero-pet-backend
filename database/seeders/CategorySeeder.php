<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Cats',
                'description' => 'This is the category of cats.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dogs',
                'description' => 'This is the category of dogs.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Birds',
                'description' => 'This is the category of birds.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
