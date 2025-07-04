<?php

namespace App\Services;

use App\Models\FormaPagamento;

class FormaPagamentoService
{
    /**
     * Cria uma nova forma de pagamento
     */
    public function criar(array $dados): FormaPagamento
    {
        return FormaPagamento::create([
            'nome' => $dados['nome'],
        ]);
    }

    /**
     * Atualiza uma forma de pagamento
     */
    public function atualizar(FormaPagamento $forma, array $dados): FormaPagamento
    {
        $forma->update([
            'nome' => $dados['nome'],
        ]);

        return $forma;
    }

    /**
     * Remove uma forma de pagamento
     */
    public function excluir(FormaPagamento $forma): void
    {
        $forma->delete();
    }
}
