<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormaPagamentoRequest extends FormRequest
{
    /**
     * Autoriza o usuário a fazer essa requisição
     */
    public function authorize(): bool
    {
        return true; // ou coloque lógica de permissão se necessário
    }

    /**
     * Regras de validação
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
        ];
    }

    /**
     * Mensagens personalizadas (opcional)
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome da forma de pagamento é obrigatório.',
            'nome.string' => 'O nome deve ser um texto.',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres.',
        ];
    }
}
