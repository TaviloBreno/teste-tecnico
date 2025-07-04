<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permitir requisição de qualquer usuário autenticado
    }

    public function rules(): array
    {
        return [
            'cliente_id' => 'nullable|exists:clientes,id',
            'forma_pagamento_id' => 'required|exists:forma_pagamentos,id',
            'itens' => 'required|array|min:1',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'parcelas' => 'required|integer|min:1|max:60',
        ];
    }

    public function messages(): array
    {
        return [
            'forma_pagamento_id.required' => 'A forma de pagamento é obrigatória.',
            'itens.required' => 'Você precisa adicionar ao menos um item à venda.',
            'itens.*.produto_id.required' => 'Selecione um produto para cada item.',
            'itens.*.quantidade.min' => 'A quantidade deve ser pelo menos 1.',
        ];
    }
}
