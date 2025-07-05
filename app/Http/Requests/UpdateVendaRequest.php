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
            'quantidade_parcelas' => 'required|integer|min:1|max:60',
            'itens' => 'required|array|min:1',
            'itens.*.produto_id' => 'required_with:itens.*.quantidade|exists:produtos,id',
            'itens.*.quantidade' => 'nullable|integer|min:1',
            'parcelas' => 'sometimes|array',
            'parcelas.*.valor' => 'required_with:parcelas|numeric|min:0.01',
            'parcelas.*.vencimento' => 'required_with:parcelas|date',
        ];
    }

    public function messages(): array
    {
        return [
            'forma_pagamento_id.required' => 'A forma de pagamento é obrigatória.',
            'data.required' => 'A data da venda é obrigatória.',
            'data.date' => 'A data deve ser uma data válida.',
            'quantidade_parcelas.required' => 'O número de parcelas é obrigatório.',
            'quantidade_parcelas.integer' => 'O número de parcelas deve ser um número inteiro.',
            'quantidade_parcelas.min' => 'O número de parcelas deve ser pelo menos 1.',
            'quantidade_parcelas.max' => 'O número de parcelas não pode ser maior que 60.',
            'itens.required' => 'Você precisa adicionar ao menos um item à venda.',
            'itens.*.produto_id.required_with' => 'Selecione um produto para cada item.',
            'itens.*.quantidade.min' => 'A quantidade deve ser pelo menos 1.',
            'parcelas.*.valor.required_with' => 'O valor da parcela é obrigatório.',
            'parcelas.*.vencimento.required_with' => 'A data de vencimento da parcela é obrigatória.',
        ];
    }
}
