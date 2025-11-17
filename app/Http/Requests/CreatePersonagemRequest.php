<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePersonagemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'       => 'required|string',
            'sobrenome'  => 'required|string',
            'raca'       => 'required|string',
            'classe'     => 'required|string',
            'atributos'  => 'required|array',
            'poderes'    => 'nullable|string',
            'historia'   => 'nullable|string',
            'inventario' => 'nullable|string',
        ];
    }
}
