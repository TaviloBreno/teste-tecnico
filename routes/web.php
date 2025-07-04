<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\ItemVendaController;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
});




require __DIR__.'/auth.php';
