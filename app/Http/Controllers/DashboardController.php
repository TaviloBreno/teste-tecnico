<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalProdutos = Produto::count();
        $totalVendas = Venda::count();
        $valorTotalVendas = Venda::sum('valor_total');

        // Gerar os últimos 6 meses
        $meses = collect();
        for ($i = 5; $i >= 0; $i--) {
            $meses->push(Carbon::now()->subMonths($i)->format('m/Y'));
        }

        // Buscar vendas agrupadas por mês
        $vendasPorMes = Venda::selectRaw('DATE_FORMAT(created_at, "%m/%Y") as mes, SUM(valor_total) as total')
            ->where('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())
            ->groupBy('mes')
            ->orderByRaw('MIN(created_at)')
            ->pluck('total', 'mes');

        // Garantir que todos os meses estejam presentes no gráfico (mesmo com 0)
        $labels = $meses;
        $valores = $meses->map(fn($mes) => $vendasPorMes->get($mes, 0));

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
