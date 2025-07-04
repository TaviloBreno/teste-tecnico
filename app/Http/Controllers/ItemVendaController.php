<?php

namespace App\Http\Controllers;

use App\Models\ItemVenda;
use App\Http\Requests\StoreItemVendaRequest;
use App\Http\Requests\UpdateItemVendaRequest;
use App\Services\ItemVendaService;

class ItemVendaController extends Controller
{
    public function store(StoreItemVendaRequest $request, ItemVendaService $service)
    {
        $item = $service->criar($request->validated());

        return redirect()->route('vendas.show', $item->venda_id)
                         ->with('success', 'Item adicionado à venda com sucesso!');
    }

    public function edit(ItemVenda $itemVenda)
    {
        return view('itens.edit', compact('itemVenda'));
    }

    public function update(UpdateItemVendaRequest $request, ItemVenda $itemVenda, ItemVendaService $service)
    {
        $service->atualizar($itemVenda, $request->validated());

        return redirect()->route('vendas.show', $itemVenda->venda_id)
                         ->with('success', 'Item atualizado com sucesso!');
    }

    public function destroy(ItemVenda $itemVenda, ItemVendaService $service)
    {
        $vendaId = $itemVenda->venda_id;
        $service->excluir($itemVenda);

        return redirect()->route('vendas.show', $vendaId)
                         ->with('success', 'Item removido da venda.');
    }
}
