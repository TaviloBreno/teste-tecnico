<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::insert([
            [
                'nome' => 'João Silva',
                'email' => 'joao@email.com',
                'telefone' => '(11) 91234-5678',
            ],
            [
                'nome' => 'Maria Oliveira',
                'email' => 'maria@email.com',
                'telefone' => '(21) 99876-5432',
            ],
            [
                'nome' => 'Carlos Souza',
                'email' => 'carlos@email.com',
                'telefone' => '(31) 98765-4321',
            ],
        ]);
    }
}
