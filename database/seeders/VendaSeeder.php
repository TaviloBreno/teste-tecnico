<?php

namespace Database\Seeders;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\FormaPagamento;
use Illuminate\Database\Seeder;
use App\Models\User;

class VendaSeeder extends Seeder
{
    public function run(): void
{
    $clientes = Cliente::all();
    $formas = FormaPagamento::all();
    $user = User::first(); // pega o primeiro usuário (ex: admin)

    if ($clientes->isEmpty() || $formas->isEmpty() || !$user) {
        $this->command->warn("Usuários, clientes ou formas de pagamento não encontrados. Execute os seeders antes.");
        return;
    }

    foreach ($clientes as $cliente) {
        $forma = $formas->random();

        Venda::create([
            'user_id' => $user->id, // Adicionado aqui
            'cliente_id' => $cliente->id,
            'forma_pagamento_id' => $forma->id,
            'data' => now()->subDays(rand(0, 30)),
            'valor_total' => rand(100, 2000),
        ]);
    }
}
}
