<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'documento',
    ];

    protected $casts = [
        'email' => 'string',
        'telefone' => 'string',
        'documento' => 'string',
    ];

    /**
     * Vendas feitas para esse cliente
     */
    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
