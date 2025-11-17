<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonagemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'nome'       => $this->nome,
            'sobrenome'  => $this->sobrenome,
            'raca'       => $this->raca,
            'classe'     => $this->classe,
            'atributos'  => $this->atributos,
            'poderes'    => $this->poderes,
            'historia'   => $this->historia,
            'inventario' => $this->inventario,
            'user_id'    => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
