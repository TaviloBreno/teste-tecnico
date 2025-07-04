<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $clientes = Cliente::when($busca, function ($query, $busca) {
            $query->where('nome', 'like', "%$busca%")
                ->orWhere('email', 'like', "%$busca%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('clientes.index', compact('clientes', 'busca'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest $request)
    {
        Cliente::create($request->validated());

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente, ClienteService $clienteService)
    {
        $clienteService->atualizarCliente($cliente, $request->validated());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente, ClienteService $clienteService)
    {
        $clienteService->excluirCliente($cliente);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente removido com sucesso!');
    }
}
