<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormaPagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    /**
     * Vendas associadas a esta forma de pagamento
     */
    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
