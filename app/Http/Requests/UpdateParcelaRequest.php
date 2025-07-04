<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParcelaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vencimento' => 'required|date|after_or_equal:today',
            'valor' => 'required|numeric|min:0',
            'paga' => 'nullable|boolean',
        ];
    }
}
