<?php

namespace App\Services;

use App\Models\Cliente;

class ClienteService
{
    /**
     * Cria um novo cliente
     */
    public function criarCliente(array $dados): Cliente
    {
        return Cliente::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'] ?? null,
            'telefone' => $dados['telefone'] ?? null,
            'documento' => $dados['documento'] ?? null,
        ]);
    }

    /**
     * Atualiza um cliente existente
     */
    public function atualizarCliente(Cliente $cliente, array $dados): Cliente
    {
        $cliente->update([
            'nome' => $dados['nome'],
            'email' => $dados['email'] ?? null,
            'telefone' => $dados['telefone'] ?? null,
            'documento' => $dados['documento'] ?? null,
        ]);

        return $cliente;
    }

    /**
     * Exclui um cliente
     */
    public function excluirCliente(Cliente $cliente): void
    {
        $cliente->delete();
    }
}
