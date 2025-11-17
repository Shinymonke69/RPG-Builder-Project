<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonagemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'       => 'sometimes|required|string',
            'sobrenome'  => 'sometimes|required|string',
            'raca'       => 'sometimes|required|string',
            'classe'     => 'sometimes|required|string',
            'atributos'  => 'sometimes|required|array',
            'poderes'    => 'nullable|string',
            'historia'   => 'nullable|string',
            'inventario' => 'nullable|string',
        ];
    }
}