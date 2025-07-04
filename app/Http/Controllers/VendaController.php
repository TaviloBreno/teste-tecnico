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
        try {
            $dados = $request->validated();

            // Filtrar e reindexar produtos válidos
            $dados['itens'] = array_values(array_filter($dados['itens'], function ($item) {
                return isset($item['quantidade']) && $item['quantidade'] > 0;
            }));

            if (empty($dados['itens'])) {
                return back()->withErrors(['itens' => 'Selecione ao menos um produto com quantidade válida.'])->withInput();
            }

            // Renomear a chave 'quantidade_parcelas' para 'parcelas'
            $dados['parcelas'] = $dados['quantidade_parcelas'];

            $venda = $vendaService->criarVenda($dados);

            return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso!');
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors(['error' => 'Erro ao salvar venda: ' . $e->getMessage()])->withInput();
        }
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

        $venda->loadMissing(['itens.produto', 'parcelas']);

        return view('vendas.edit', compact('venda', 'clientes', 'produtos', 'formasPagamento'));
    }

    public function update(UpdateVendaRequest $request, Venda $venda, VendaService $vendaService)
    {
        try {
            $dados = $request->validated();

            $dados['itens'] = array_values(array_filter($dados['itens'], function ($item) {
                return isset($item['quantidade']) && $item['quantidade'] > 0;
            }));

            $dados['parcelas'] = array_values(array_filter($dados['parcelas'], function ($parcela) {
                return isset($parcela['valor']) && isset($parcela['vencimento']);
            }));

            $vendaService->atualizarVenda($venda, $dados);

            return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors(['error' => 'Erro ao atualizar venda: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Venda $venda)
    {
        if ($venda->exists()) {
            $venda->parcelas()->delete();
            $venda->itens()->delete();
            $venda->delete();
        }

        return redirect()->route('vendas.index')->with('success', 'Venda excluída com sucesso!');
    }
}
