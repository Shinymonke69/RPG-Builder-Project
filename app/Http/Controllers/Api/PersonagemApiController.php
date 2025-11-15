<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePersonagemRequest;
use App\Http\Requests\UpdatePersonagemRequest;
use App\Http\Resources\PersonagemResource;
use App\Http\Services\PersonagemService;
use Illuminate\Support\Facades\Auth;

class PersonagemApiController extends Controller
{
    protected PersonagemService $service;

    public function __construct(PersonagemService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $personagens = $this->service->index(Auth::id());
        return PersonagemResource::collection($personagens);
    }

    public function store(CreatePersonagemRequest $request)
    {
        $personagem = $this->service->store($request->validated(), Auth::id());
        return new PersonagemResource($personagem);
    }

    public function show($id)
    {
        $personagem = $this->service->show($id, Auth::id());
        return new PersonagemResource($personagem);
    }

    public function update(UpdatePersonagemRequest $request, $id)
    {
        $personagem = $this->service->update($request->validated(), $id, Auth::id());
        return new PersonagemResource($personagem);
    }

    public function destroy($id)
    {
        $this->service->destroy($id, Auth::id());
        return response()->noContent();
    }
}
