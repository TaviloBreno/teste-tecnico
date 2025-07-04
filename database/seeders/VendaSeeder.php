<?php

namespace Database\Seeders;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\FormaPagamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VendaSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = Cliente::all();
        $formas = FormaPagamento::all();

        if ($clientes->isEmpty() || $formas->isEmpty()) {
            $this->command->warn("Clientes ou formas de pagamento não encontrados. Execute os seeders antes.");
            return;
        }

        foreach ($clientes as $cliente) {
            $forma = $formas->random();

            Venda::create([
                'cliente_id' => $cliente->id,
                'forma_pagamento_id' => $forma->id,
                'data' => Carbon::now()->subDays(rand(0, 30)),
                'total' => rand(100, 2000), // valor fictício
            ]);
        }
    }
}
