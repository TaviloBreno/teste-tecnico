<?php

namespace App\Services;

use App\Models\Venda;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendaService
{
    public function criarVenda(array $dados): Venda
    {
        return DB::transaction(function () use ($dados) {
            $this->validarEstoque($dados['itens']);

            $venda = Venda::create([
                'user_id' => Auth::id(),
                'cliente_id' => $dados['cliente_id'] ?? null,
                'forma_pagamento_id' => $dados['forma_pagamento_id'],
                'valor_total' => 0,
                'data' => now()->toDateString(),
            ]);

            $total = $this->processarItens($venda, $dados['itens']);
            $venda->update(['valor_total' => $total]);

            $quantidadeParcelas = $dados['quantidade_parcelas'] ?? 1;
            $this->gerarParcelas($venda, $quantidadeParcelas, $total);

            return $venda;
        });
    }

    public function atualizarVenda(Venda $venda, array $dados): Venda
    {
        return DB::transaction(function () use ($venda, $dados) {
            $this->restaurarEstoque($venda);
            $this->validarEstoque($dados['itens']);

            $venda->update([
                'cliente_id' => $dados['cliente_id'] ?? null,
                'forma_pagamento_id' => $dados['forma_pagamento_id'],
            ]);

            $venda->itens()->delete();
            $venda->parcelas()->delete();

            $total = $this->processarItens($venda, $dados['itens']);
            $venda->update(['valor_total' => $total]);

            $quantidadeParcelas = $dados['quantidade_parcelas'] ?? 1;
            $this->gerarParcelas($venda, $quantidadeParcelas, $total);

            return $venda;
        });
    }

    private function processarItens(Venda $venda, array $itens): float
    {
        $total = 0;

        foreach ($itens as $item) {
            $produto = Produto::findOrFail($item['produto_id']);
            $quantidade = $item['quantidade'];
            $preco = $produto->preco;
            $subtotal = $preco * $quantidade;

            $produto->decrement('estoque', $quantidade);

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

    private function gerarParcelas(Venda $venda, int $quantidadeParcelas, float $total): void
    {
        if ($quantidadeParcelas < 1) $quantidadeParcelas = 1;

        $valorParcela = round($total / $quantidadeParcelas, 2);
        $valorCorrigido = $valorParcela * $quantidadeParcelas;
        $diferenca = round($total - $valorCorrigido, 2);
        $ultimaParcelaValor = $valorParcela + $diferenca;

        for ($i = 1; $i <= $quantidadeParcelas; $i++) {
            $venda->parcelas()->create([
                'vencimento' => now()->addMonths($i),
                'valor' => ($i === $quantidadeParcelas) ? $ultimaParcelaValor : $valorParcela,
            ]);
        }
    }

    private function restaurarEstoque(Venda $venda): void
    {
        if (!$venda->relationLoaded('itens')) {
            $venda->load('itens');
        }

        foreach ($venda->itens as $item) {
            $produto = Produto::find($item->produto_id);
            if ($produto) {
                $produto->increment('estoque', $item->quantidade);
            }
        }
    }

    public function cancelarVenda(Venda $venda): void
    {
        DB::transaction(function () use ($venda) {
            $this->restaurarEstoque($venda);
            $venda->parcelas()->delete();
            $venda->itens()->delete();
            $venda->delete();
        });
    }

    private function validarEstoque(array $itens): void
    {
        $erros = [];

        foreach ($itens as $item) {
            $produto = Produto::findOrFail($item['produto_id']);
            $quantidade = $item['quantidade'];

            if ($produto->estoque < $quantidade) {
                $erros[] = "Estoque insuficiente para o produto '{$produto->nome}'. Disponível: {$produto->estoque}, Solicitado: {$quantidade}";
            }
        }

        if (!empty($erros)) {
            throw new \Exception(implode(' | ', $erros));
        }
    }
}
