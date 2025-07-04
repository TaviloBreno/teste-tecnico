<?php

namespace App\Services;

use App\Models\Parcela;

class ParcelaService
{
    /**
     * Marcar uma parcela como paga
     */
    public function marcarComoPaga(Parcela $parcela): Parcela
    {
        $parcela->update([
            'paga' => true,
        ]);

        return $parcela;
    }

    /**
     * Marcar uma parcela como não paga
     */
    public function marcarComoNaoPaga(Parcela $parcela): Parcela
    {
        $parcela->update([
            'paga' => false,
        ]);

        return $parcela;
    }

    /**
     * Atualizar valor e/ou vencimento da parcela
     */
    public function atualizarDados(Parcela $parcela, array $dados): Parcela
    {
        $parcela->update([
            'vencimento' => $dados['vencimento'] ?? $parcela->vencimento,
            'valor' => $dados['valor'] ?? $parcela->valor,
        ]);

        return $parcela;
    }
}
