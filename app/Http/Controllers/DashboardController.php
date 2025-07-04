<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalClientes' => Cliente::count(),
            'totalProdutos' => Produto::count(),
            'totalVendas' => Venda::count(),
            'valorTotalVendas' => Venda::sum('valor_total'),
        ]);
    }
}

