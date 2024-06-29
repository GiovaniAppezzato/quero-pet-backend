<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'Gatos',
                'description' => 'Esta é a categoria de gatos.',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => 'cat'
            ],
            [
                'name' => 'Cachorros',
                'description' => 'Esta é a categoria de cachorros.',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => 'dog'
            ],
            [
                'name' => 'Pássaros',
                'description' => 'Esta é a categoria de pássaros.',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => 'bird'
            ],
            [
                'name' => 'Peixes',
                'description' => 'Esta é a categoria de peixes.',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => 'fish'
            ],
            [
                'name' => 'Roedores',
                'description' => 'Esta é a categoria de Roedores.',
                'created_at' => now(),
                'updated_at' => now(),
                'icon' => 'rodent'
            ]
        ]);
    }
}
