<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personagem;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\PersonagemService;

class PersonagemController extends Controller
{
    protected PersonagemService $service;

    public function __construct(PersonagemService $service)
    {
        $this->service = $service;
    }

    // Listagem paginada na view
    public function index()
    {
        $personagens = $this->service->index(Auth::id());
        return view('personagens.index', compact('personagens'));
    }

    // Exibe formulário de criação, já com dados sorteados
    public function create()
    {
        $dadosGerados = $this->service->generatePersonagemData();
        return view('personagens.create', $dadosGerados);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'       => 'required|string',
            'sobrenome'  => 'required|string',
            'raca'       => 'required|string',
            'classe'     => 'required|string',
            'atributos'  => 'required',
            'poderes'    => 'nullable|string',
            'historia'   => 'nullable|string',
            'inventario' => 'nullable|string',
        ]);
        $this->service->store($data, Auth::id());
        return redirect()->route('personagens.index')->with('Sucesso', 'Personagem criado com sucesso!');
    }

    public function show($id)
    {
        $personagem = $this->service->show($id, Auth::id());
        return view('personagens.show', compact('personagem'));
    }

    public function edit($id)
    {
        $personagem = $this->service->show($id, Auth::id());
        return view('personagens.edit', compact('personagem'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nome'       => 'required|string',
            'sobrenome'  => 'required|string',
            'raca'       => 'required|string',
            'classe'     => 'required|string',
            'atributos'  => 'required',
            'poderes'    => 'nullable|string',
            'historia'   => 'nullable|string',
            'inventario' => 'nullable|string',
        ]);
        $this->service->update($data, $id, Auth::id());
        return redirect()->route('personagens.index')->with('Sucesso', 'Personagem atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $this->service->destroy($id, Auth::id());
        return redirect()->route('personagens.index')->with('success', 'Personagem removido com sucesso!');
    }
}
