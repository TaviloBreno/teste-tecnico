<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalProdutos = Produto::count();
        $totalVendas = Venda::count();
        $valorTotalVendas = Venda::sum('valor_total');

        // Agrupar vendas por mês (últimos 6 meses)
        $vendasPorMes = Venda::selectRaw('DATE_FORMAT(created_at, "%m/%Y") as mes, SUM(valor_total) as total')
            ->groupBy('mes')
            ->orderByRaw('MIN(created_at) ASC')
            ->take(6)
            ->get();

        // Separar labels e dados
        $labels = $vendasPorMes->pluck('mes');
        $valores = $vendasPorMes->pluck('total');

        return view('dashboard', compact(
            'totalClientes',
            'totalProdutos',
            'totalVendas',
            'valorTotalVendas',
            'labels',
            'valores'
        ));
    }
}
