<?php

namespace App\Http\Controllers;

use App\Models\FormaPagamento;
use App\Http\Requests\StoreFormaPagamentoRequest;
use App\Http\Requests\UpdateFormaPagamentoRequest;
use App\Services\FormaPagamentoService;

class FormaPagamentoController extends Controller
{
    public function index()
    {
        $formasPagamento = FormaPagamento::orderBy('nome')->paginate(10);
        return view('forma_pagamentos.index', compact('formasPagamento'));
    }

    public function create()
    {
        return view('forma_pagamentos.create');
    }

    public function store(StoreFormaPagamentoRequest $request, FormaPagamentoService $service)
    {
        $service->criar($request->validated());

        return redirect()->route('forma-pagamentos.index')
                         ->with('success', 'Forma de pagamento cadastrada com sucesso!');
    }

    public function edit(FormaPagamento $formaPagamento)
    {
        return view('forma_pagamentos.edit', compact('formaPagamento'));
    }

    public function update(UpdateFormaPagamentoRequest $request, FormaPagamento $formaPagamento, FormaPagamentoService $service)
    {
        $service->atualizar($formaPagamento, $request->validated());

        return redirect()->route('forma-pagamentos.index')
                         ->with('success', 'Forma de pagamento atualizada com sucesso!');
    }

    public function destroy(FormaPagamento $formaPagamento, FormaPagamentoService $service)
    {
        $service->excluir($formaPagamento);

        return redirect()->route('forma-pagamentos.index')
                         ->with('success', 'Forma de pagamento removida com sucesso!');
    }
}
