<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parcela extends Model
{
    use HasFactory;

    protected $fillable = [
        'venda_id',
        'vencimento',
        'valor',
        'paga',
    ];

    protected $casts = [
        'vencimento' => 'date',
        'valor' => 'decimal:2',
        'paga' => 'boolean',
    ];

    /**
     * Venda associada à parcela
     */
    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
