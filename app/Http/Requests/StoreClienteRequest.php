<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|unique:clientes,email',
            'telefone' => 'nullable|string|max:20',
        ];
    }
}

