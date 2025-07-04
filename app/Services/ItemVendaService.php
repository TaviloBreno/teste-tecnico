<?php

namespace App\Services;

use App\Models\ItemVenda;
use App\Models\Produto;

class ItemVendaService
{
    public function criar(array $dados): ItemVenda
    {
        $produto = Produto::findOrFail($dados['produto_id']);
        $subtotal = $produto->preco * $dados['quantidade'];

        return ItemVenda::create([
            'venda_id' => $dados['venda_id'],
            'produto_id' => $produto->id,
            'quantidade' => $dados['quantidade'],
            'preco_unitario' => $produto->preco,
            'subtotal' => $subtotal,
        ]);
    }

    public function atualizar(ItemVenda $item, array $dados): ItemVenda
    {
        $item->quantidade = $dados['quantidade'];
        $item->subtotal = $item->preco_unitario * $dados['quantidade'];
        $item->save();

        return $item;
    }

    public function excluir(ItemVenda $item): void
    {
        $item->delete();
    }
}
