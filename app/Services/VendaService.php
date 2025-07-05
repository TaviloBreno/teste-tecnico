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

            $this->gerarParcelas($venda, $dados['parcelas'], $total);

            return $venda;
        });
    }

    public function atualizarVenda(Venda $venda, array $dados): Venda
    {
        return DB::transaction(function () use ($venda, $dados) {
            $this->restaurarEstoque($venda);
            $this->validarEstoque($dados['itens']);

            // Guardar parcelas originais se existirem
            $parcelasOriginais = [];
            if (isset($dados['parcelas']) && is_array($dados['parcelas'])) {
                $parcelasOriginais = $dados['parcelas'];
            }

            $venda->update([
                'cliente_id' => $dados['cliente_id'] ?? null,
                'forma_pagamento_id' => $dados['forma_pagamento_id'],
            ]);

            $venda->itens()->delete();
            $venda->parcelas()->delete();

            $total = $this->processarItens($venda, $dados['itens']);
            $venda->update(['valor_total' => $total]);

            // Se há parcelas específicas, ajustar proporcionalmente
            if (!empty($parcelasOriginais)) {
                $this->ajustarParcelasProporcionalmente($venda, $parcelasOriginais, $total);
            } else {
                // Caso contrário, usar o método padrão
                $this->gerarParcelas($venda, $dados['parcelas'], $total);
            }

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

    /**
     * Gera as parcelas da venda conforme valor total e quantidade ou array de parcelas
     */
    private function gerarParcelas(Venda $venda, $parcelas, float $total): void
    {
        // Se parcelas é um número inteiro (quantidade de parcelas)
        if (is_numeric($parcelas)) {
            $this->gerarParcelasAutomaticas($venda, (int)$parcelas, $total);
        }
        // Se parcelas é um array (parcelas específicas)
        elseif (is_array($parcelas)) {
            $this->gerarParcelasEspecificas($venda, $parcelas);
        }
        else {
            // Fallback: gerar 1 parcela
            $this->gerarParcelasAutomaticas($venda, 1, $total);
        }
    }

    /**
     * Gera parcelas automaticamente dividindo o valor total
     */
    private function gerarParcelasAutomaticas(Venda $venda, int $quantidadeParcelas, float $total): void
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

    /**
     * Gera parcelas específicas baseadas no array fornecido
     */
    private function gerarParcelasEspecificas(Venda $venda, array $parcelas): void
    {
        foreach ($parcelas as $parcela) {
            $venda->parcelas()->create([
                'vencimento' => $parcela['vencimento'],
                'valor' => $parcela['valor'],
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

    /**
     * Ajusta parcelas proporcionalmente quando o total da venda muda
     */
    private function ajustarParcelasProporcionalmente(Venda $venda, array $parcelasOriginais, float $novoTotal): void
    {
        if (empty($parcelasOriginais)) {
            // Se não há parcelas originais, usar o método padrão
            $this->gerarParcelas($venda, count($parcelasOriginais) ?: 1, $novoTotal);
            return;
        }

        $totalOriginal = array_sum(array_column($parcelasOriginais, 'valor'));
        
        if ($totalOriginal <= 0) {
            // Se o total original é zero, dividir igualmente
            $this->gerarParcelas($venda, count($parcelasOriginais), $novoTotal);
            return;
        }

        $fatorProporcional = $novoTotal / $totalOriginal;
        $somaAjustada = 0;

        foreach ($parcelasOriginais as $index => $parcela) {
            $valorAjustado = round($parcela['valor'] * $fatorProporcional, 2);
            
            // Se é a última parcela, ajustar para fechar o total exato
            if ($index === count($parcelasOriginais) - 1) {
                $valorAjustado = round($novoTotal - $somaAjustada, 2);
            }

            $venda->parcelas()->create([
                'vencimento' => $parcela['vencimento'],
                'valor' => $valorAjustado,
            ]);

            $somaAjustada += $valorAjustado;
        }
    }
}
