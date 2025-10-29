<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personagem extends Model
{
    protected $table = 'personagens';
    
    protected $fillable = [
        'user_id', 'nome', 'sobrenome', 'raça', 'classe', 'atributos', 'poderes', 'historia', 'inventario'
    ];

    protected $casts = [
        'atributos' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
