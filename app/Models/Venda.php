<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cliente_id',
        'forma_pagamento_id',
        'valor_total',
    ];

    protected $casts = [
        'valor_total' => 'decimal:2',
    ];

    // ───────────────────────────────────────────────
    // RELACIONAMENTOS
    // ───────────────────────────────────────────────

    /**
     * Vendedor responsável (usuário logado)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Cliente da venda (opcional)
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Forma de pagamento selecionada
     */
    public function formaPagamento()
    {
        return $this->belongsTo(FormaPagamento::class);
    }

    /**
     * Itens da venda
     */
    public function itens()
    {
        return $this->hasMany(ItemVenda::class);
    }

    /**
     * Parcelas da venda
     */
    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }

    // ───────────────────────────────────────────────
    // MÉTODOS DE AJUDA (opcional)
    // ───────────────────────────────────────────────

    public function estaPaga(): bool
    {
        return $this->parcelas()->count() > 0
            && $this->parcelas()->where('paga', false)->count() === 0;
    }

    public function getStatusPagamentoAttribute(): string
    {
        return $this->estaPaga() ? 'Paga' : 'Em aberto';
    }
}
