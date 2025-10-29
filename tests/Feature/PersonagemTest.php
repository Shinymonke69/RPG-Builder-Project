<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PersonagemTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_create_personagem(){
    $user = User::factory()->create();
    $this->actingAs($user)
        ->post('/personagens', [
            'nome' => 'Gandalf',
            'raça' => 'Mago',
            'classe' => 'Arcano',
            'atributos' => ['força' => 10, 'destreza' => 12],
        ])
        ->assertRedirect('/personagens');
    }
}
