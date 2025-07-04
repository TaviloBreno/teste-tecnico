<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\FormaPagamento;
use App\Models\Produto;
use App\Http\Requests\StoreVendaRequest;
use App\Http\Requests\UpdateVendaRequest;
use App\Services\VendaService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VendaController extends Controller
{
    public function index(Request $request)
    {
        $vendas = Venda::with(['cliente', 'user'])
            ->when($request->cliente_id, fn($q) => $q->where('cliente_id', $request->cliente_id))
            ->when($request->data_inicio, fn($q) => $q->whereDate('created_at', '>=', $request->data_inicio))
            ->when($request->data_fim, fn($q) => $q->whereDate('created_at', '<=', $request->data_fim))
            ->orderByDesc('created_at')
            ->paginate(10);

        $clientes = Cliente::orderBy('nome')->get();

        return view('vendas.index', compact('vendas', 'clientes'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        $formasPagamento = FormaPagamento::all();

        return view('vendas.create', compact('clientes', 'produtos', 'formasPagamento'));
    }

    public function store(StoreVendaRequest $request, VendaService $vendaService)
    {
        $venda = $vendaService->criarVenda($request->validated());

        return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso!');
    }

    public function show(Venda $venda)
    {
        $venda->load(['cliente', 'user', 'itens.produto', 'parcelas']);
        return view('vendas.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        $formasPagamento = FormaPagamento::all();

        $venda->load('itens');

        return view('vendas.edit', compact('venda', 'clientes', 'produtos', 'formasPagamento'));
    }

    public function update(UpdateVendaRequest $request, Venda $venda, VendaService $vendaService)
    {
        $vendaService->atualizarVenda($venda, $request->validated());

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(Venda $venda)
    {
        $venda->parcelas()->delete();
        $venda->itens()->delete();
        $venda->delete();

        return redirect()->route('vendas.index')->with('success', 'Venda excluída com sucesso!');
    }

    public function downloadPdf(Venda $venda)
    {
        $venda->load(['cliente', 'user', 'itens.produto', 'parcelas']);

        $pdf = Pdf::loadView('vendas.pdf', compact('venda'));

        return $pdf->download("venda-{$venda->id}.pdf");
    }
}
