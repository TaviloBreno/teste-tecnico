<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Services\ClienteService;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('nome')->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest $request, ClienteService $clienteService)
    {
        $clienteService->criarCliente($request->validated());

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente cadastrado com sucesso!');
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

