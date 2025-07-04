<?php

namespace App\Services;

use App\Models\Produto;

class ProdutoService
{
    /**
     * Cria um novo produto
     */
    public function criarProduto(array $dados): Produto
    {
        return Produto::create([
            'nome' => $dados['nome'],
            'preco' => $dados['preco'],
        ]);
    }

    /**
     * Atualiza um produto existente
     */
    public function atualizarProduto(Produto $produto, array $dados): Produto
    {
        $produto->update([
            'nome' => $dados['nome'],
            'preco' => $dados['preco'],
        ]);

        return $produto;
    }

    /**
     * Deleta um produto
     */
    public function excluirProduto(Produto $produto): void
    {
        $produto->delete();
    }

    /**
     * Lista todos os produtos
     */
    public function listarProdutos()
    {
        return Produto::all();
    }
}
