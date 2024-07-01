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
            'age' => '1 Ano',
            'weight' => '15Kg',
            'color' => 'Misto',
            'banner' => '0adf25665e98f5697ef70c27325a299af28d073d.jpeg',
            'sex' => 'M',
            'birth_date' => '2024-04-01',
            'is_vaccinated' => true,
            'ong_id' => 1,
            'category_id' => 2,
        ]);
        Pet::create([
            'name' => 'Rhaenyra',
            'description' => 'Olá, eu sou a Rhaenyra! Sou uma gatinha elegante e cheia de graça, sempre pronta para encantar com meu charme felino. Adoro brincar com bolinhas de lã, tirar longas sonecas ao sol e receber cafunés.',
            'breed' => 'Vira-lata',
            'age' => '2 Anos',
            'weight' => '4Kg',
            'color' => 'Misto',
            'banner' => '56bd3ba4a5e4bf1ef5dfd894f33f7dbb.jpg',
            'sex' => 'F',
            'birth_date' => '2023-04-01',
            'is_vaccinated' => true,
            'ong_id' => 1,
            'category_id' => 1,
        ]);
        Pet::create([
            'name' => 'Rhaegal',
            'description' => 'Oi, eu sou o Rhaegal! Sou uma calopsita alegre e cheia de vida, sempre pronta para cantarolar e alegrar seu dia. Adoro voar pelo ambiente, brincar com meus brinquedos e receber atenção. ',
            'breed' => 'Comum',
            'age' => '7 Meses',
            'weight' => '0.09 Kg',
            'color' => 'Cinza',
            'banner' => 'a25a9bd1a852b1c6000731671bd03173.jpg',
            'sex' => 'M',
            'birth_date' => '2024-04-01',
            'is_vaccinated' => true,
            'ong_id' => 1,
            'category_id' => 3,
        ]);
        Pet::create([
            'name' => 'Aegon',
            'description' => 'Oi, eu sou o Aegon! Sou um hamster pequenino, mas com um coração gigante. Adoro correr na minha rodinha, explorar novos cantinhos e roer meus brinquedos. ',
            'breed' => 'Sírio',
            'age' => '2 Meses',
            'weight' => '0.1 Kg',
            'color' => 'Marrom',
            'banner' => '69340fa648d8410468b80bd71cb588ed.jpg',
            'sex' => 'M',
            'birth_date' => '2024-04-01',
            'is_vaccinated' => true,
            'ong_id' => 1,
            'category_id' => 5,
        ]);
        Pet::create([
            'name' => 'Arya',
            'description' => 'Oi, eu sou a Arya! Sou um peixinho gracioso e cheio de personalidade, nadando com elegância em meu aquário.',
            'breed' => 'Comum',
            'age' => '5 Meses',
            'weight' => '0.01 Kg',
            'color' => 'Branco',
            'banner' => 'e0927d624bf4cd25c18a18a896cca127.jpg',
            'sex' => 'F',
            'birth_date' => '2024-04-01',
            'is_vaccinated' => true,
            'ong_id' => 1,
            'category_id' => 4,
        ]);
    }
}
