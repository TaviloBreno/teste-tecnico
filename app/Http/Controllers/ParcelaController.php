<?php

namespace App\Http\Controllers;

use App\Models\Parcela;
use App\Http\Requests\UpdateParcelaRequest;
use App\Services\ParcelaService;

class ParcelaController extends Controller
{
    public function index()
    {
        $parcelas = Parcela::with('venda.cliente')->latest()->paginate(10);
        return view('parcelas.index', compact('parcelas'));
    }

    public function edit(Parcela $parcela)
    {
        return view('parcelas.edit', compact('parcela'));
    }

    public function update(UpdateParcelaRequest $request, Parcela $parcela, ParcelaService $parcelaService)
    {
        $parcelaService->atualizarDados($parcela, $request->validated());

        if ($request->filled('paga')) {
            if ($request->boolean('paga')) {
                $parcelaService->marcarComoPaga($parcela);
            } else {
                $parcelaService->marcarComoNaoPaga($parcela);
            }
        }

        return redirect()->route('parcelas.index')->with('success', 'Parcela atualizada com sucesso!');
    }

    public function destroy(Parcela $parcela)
    {
        $parcela->delete();
        return redirect()->route('parcelas.index')->with('success', 'Parcela excluída com sucesso!');
    }
}
