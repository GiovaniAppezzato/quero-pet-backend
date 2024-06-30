<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pet::create([
            'name' => 'Toretto',
            'description' => 'Oi, eu sou o Toretto! Sou um cachorrinho carinhoso e cheio de energia. Adoro correr, brincar e receber carinhos. Meu maior sonho é encontrar uma família amorosa para chamar de minha. Prometo retribuir com lambidas e lealdade. Venha me conhecer e deixe seu coração ser conquistado!',
            'breed' => 'Vira-lata',
            'age' => '11 Meses',
            'weight' => '15Kg',
            'color' => 'Misto',
            'banner' => '0adf25665e98f5697ef70c27325a299af28d073d.jpeg',
            'sex' => 'M',
            'birth_date' => '2024-04-01',
            'is_vaccinated' => true,
            'ong_id' => 1,
            'category_id' => 2,
        ]);
    }
}
