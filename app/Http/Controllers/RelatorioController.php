<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RelatorioController extends Controller
{
    public function index()
    {
        $vendas = Venda::with('cliente', 'formaPagamento')->latest()->paginate(10);

        return view('relatorios.index', compact('vendas'));
    }

    public function vendasPdf()
    {
        $vendas = Venda::with('cliente', 'formaPagamento')->latest()->get();

        $pdf = Pdf::loadView('relatorios.pdf', compact('vendas'));

        return $pdf->download('relatorio-vendas.pdf');
    }

    public function vendasCsv()
    {
        $vendas = Venda::with(['cliente', 'formaPagamento'])->get();

        $csvHeaders = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="relatorio_vendas.csv"',
        ];

        $callback = function () use ($vendas) {
            $file = fopen('php://output', 'w');

            // Cabeçalho do CSV
            fputcsv($file, ['ID', 'Cliente', 'Forma de Pagamento', 'Data', 'Valor Total']);

            // Linhas
            foreach ($vendas as $venda) {
                fputcsv($file, [
                    $venda->id,
                    $venda->cliente->nome ?? 'N/A',
                    $venda->formaPagamento->nome ?? 'N/A',
                    $venda->created_at->format('d/m/Y'),
                    number_format($venda->valor_total, 2, ',', ''),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $csvHeaders);
    }
}
