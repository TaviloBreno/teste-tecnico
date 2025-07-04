<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $produtos = Produto::when($busca, function ($query, $busca) {
            return $query->where('nome', 'like', "%{$busca}%");
        })->paginate(10);

        return view('produtos.index', compact('produtos', 'busca'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(StoreProdutoRequest $request, ProdutoService $produtoService)
    {
        $produtoService->criarProduto($request->validated());
        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(UpdateProdutoRequest $request, Produto $produto, ProdutoService $produtoService)
    {
        $produtoService->atualizarProduto($produto, $request->validated());
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto, ProdutoService $produtoService)
    {
        $produtoService->excluirProduto($produto);
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
