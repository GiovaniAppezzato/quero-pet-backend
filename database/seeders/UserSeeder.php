<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserTypeEnum;
use App\Models\Address;
use App\Models\User;

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

        User::create([
            'email' => 'ongdoamor@gmail.com',
            'password' => Hash::make('123mudar'),
            'user_type_id' => UserTypeEnum::ONG->value,
        ])
            ->ong()
            ->create([
                'name' => 'Ong do Amor',
                'description' => 'A Ong do Amor é uma organização sem fins lucrativos que atua na proteção e defesa dos animais. Nossa missão é resgatar, tratar e encontrar lares amorosos para animais em situação de risco. Contamos com uma equipe de voluntários dedicados e apaixonados por animais. Junte-se a nós e faça parte dessa corrente do bem!',
                'cnpj' => '12.345.678/0001-90',
                'phone' => '(11) 98765-4321',
                'responsible_name' => 'João da Silva',
                'responsible_phone' => '(11) 91234-5678',
                'responsible_cpf' => '123.456.789-00',
                'status' => 'approved',
                'approved_at' => now(),
                'approved_by' => 1,
            ]);

        Address::create([
            'zip_code' => '12345-678',
            'street' => 'Rua das Flores',
            'number' => '123',
            'neighborhood' => 'Jardim das Rosas',
            'city' => 'São Paulo',
            'state' => 'SP',
            'country' => 'Brasil',
            'user_id' => 2,
        ]);
    }
}
