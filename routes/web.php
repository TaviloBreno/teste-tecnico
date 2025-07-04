<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\ItemVendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FormaPagamentoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RelatorioController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Produtos
    Route::resource('produtos', ProdutoController::class);

    // Vendas
    Route::resource('vendas', VendaController::class);
    Route::get('/vendas/{venda}/pdf', [VendaController::class, 'downloadPdf'])->name('vendas.pdf');

    Route::resource('parcelas', ParcelaController::class)->except(['create', 'store', 'show']);

    Route::resource('itens-venda', ItemVendaController::class)->only(['store', 'edit', 'update', 'destroy']);

    Route::resource('clientes', ClienteController::class);

    Route::resource('forma-pagamentos', FormaPagamentoController::class);

    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
    Route::get('/relatorios/vendas/pdf', [RelatorioController::class, 'vendasPdf'])->name('relatorios.vendas.pdf');
    Route::get('/relatorios/vendas/csv', [RelatorioController::class, 'vendasCsv'])->name('relatorios.vendas.csv');
});




require __DIR__ . '/auth.php';
