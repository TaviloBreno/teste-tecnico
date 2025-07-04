<?php

namespace App\Services;

use App\Models\Venda;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendaService
{
    /**
     * Cria uma nova venda com itens e parcelas
     */
    public function criarVenda(array $dados): Venda
    {
        return DB::transaction(function () use ($dados) {
            $venda = Venda::create([
                'user_id' => Auth::id(),
                'cliente_id' => $dados['cliente_id'] ?? null,
                'forma_pagamento_id' => $dados['forma_pagamento_id'],
                'valor_total' => 0, // Será atualizado
            ]);

            $total = $this->processarItens($venda, $dados['itens']);
            $venda->update(['valor_total' => $total]);

            $this->gerarParcelas($venda, $dados['parcelas'], $total);

            return $venda;
        });
    }

    /**
     * Atualiza uma venda existente com novos dados
     */
    public function atualizarVenda(Venda $venda, array $dados): Venda
    {
        return DB::transaction(function () use ($venda, $dados) {
            // Atualizar dados básicos
            $venda->update([
                'cliente_id' => $dados['cliente_id'] ?? null,
                'forma_pagamento_id' => $dados['forma_pagamento_id'],
            ]);

            // Deleta os itens e parcelas anteriores
            $venda->itens()->delete();
            $venda->parcelas()->delete();

            // Reinsere itens e recalcula total
            $total = $this->processarItens($venda, $dados['itens']);
            $venda->update(['valor_total' => $total]);

            // Recria parcelas
            $this->gerarParcelas($venda, $dados['parcelas'], $total);

            return $venda;
        });
    }

    /**
     * Processa os itens da venda e calcula o total
     */
    private function processarItens(Venda $venda, array $itens): float
    {
        $total = 0;

        foreach ($itens as $item) {
            $produto = Produto::findOrFail($item['produto_id']);
            $quantidade = $item['quantidade'];
            $preco = $produto->preco;
            $subtotal = $preco * $quantidade;

            $venda->itens()->create([
                'produto_id' => $produto->id,
                'quantidade' => $quantidade,
                'preco_unitario' => $preco,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        return round($total, 2);
    }

    /**
     * Gera as parcelas da venda conforme valor total e quantidade
     */
    private function gerarParcelas(Venda $venda, int $quantidadeParcelas, float $total): void
    {
        if ($quantidadeParcelas < 1) $quantidadeParcelas = 1;

        $valorParcela = round($total / $quantidadeParcelas, 2);
        $valorCorrigido = $valorParcela * $quantidadeParcelas;

        // Ajustar última parcela se houver arredondamento
        $diferenca = round($total - $valorCorrigido, 2);
        $ultimaParcelaValor = $valorParcela + $diferenca;

        for ($i = 1; $i <= $quantidadeParcelas; $i++) {
            $venda->parcelas()->create([
                'vencimento' => now()->addMonths($i),
                'valor' => ($i === $quantidadeParcelas) ? $ultimaParcelaValor : $valorParcela,
            ]);
        }
    }
}
