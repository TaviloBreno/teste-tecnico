<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    /**
     * Autoriza a requisição (pode adicionar lógica de permissão se necessário)
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'documento' => 'nullable|string|max:20',
        ];
    }

    /**
     * Mensagens personalizadas (opcional)
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do cliente é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'telefone.max' => 'O telefone deve ter no máximo 20 caracteres.',
            'documento.max' => 'O documento deve ter no máximo 20 caracteres.',
        ];
    }
}
