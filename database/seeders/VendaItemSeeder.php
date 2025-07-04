<?php

namespace Database\Seeders;

use App\Models\Venda;
use App\Models\Produto;
use App\Models\ItemVenda as VendaItem;
use Illuminate\Database\Seeder;

class VendaItemSeeder extends Seeder
{
    public function run(): void
    {
        $vendas = Venda::all();
        $produtos = Produto::all();

        if ($vendas->isEmpty() || $produtos->isEmpty()) {
            $this->command->warn('Vendas ou produtos não encontrados. Execute os seeders anteriores.');
            return;
        }

        foreach ($vendas as $venda) {
            $numItens = rand(1, 3);
            $itensSelecionados = $produtos->random($numItens);

            $totalVenda = 0;

            foreach ($itensSelecionados as $produto) {
                $quantidade = rand(1, 5);
                $subtotal = $produto->preco * $quantidade;

                VendaItem::create([
                    'venda_id' => $venda->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $quantidade,
                    'preco_unitario' => $produto->preco,
                    'subtotal' => $subtotal,
                ]);

                $totalVenda += $subtotal;
            }

            // Atualiza o total da venda
            $venda->update(['total' => $totalVenda]);
        }
    }
}
