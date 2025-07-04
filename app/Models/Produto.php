<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',
    ];

    protected $casts = [
        'preco' => 'decimal:2',
    ];

    // ───────────────────────────────────────────────
    // RELACIONAMENTOS
    // ───────────────────────────────────────────────

    /**
     * Itens de venda que referenciam esse produto
     */
    public function itensVenda()
    {
        return $this->hasMany(ItemVenda::class);
    }
}