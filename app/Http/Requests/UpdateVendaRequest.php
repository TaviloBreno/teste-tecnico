<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id' => 'nullable|exists:clientes,id',
            'forma_pagamento_id' => 'required|exists:forma_pagamentos,id',
            'data' => 'required|date',
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
            'data.required' => 'A data da venda é obrigatória.',
            'data.date' => 'A data deve ser uma data válida.',
            'itens.required' => 'Você precisa adicionar ao menos um item à venda.',
            'itens.*.produto_id.required' => 'Selecione um produto para cada item.',
            'itens.*.quantidade.min' => 'A quantidade deve ser pelo menos 1.',
        ];
    }
}
