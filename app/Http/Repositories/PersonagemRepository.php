<?php

namespace App\Http\Repositories;

use App\Models\Personagem;

class PersonagemRepository
{
    protected Personagem $model;

    public function __construct(Personagem $model)
    {
        $this->model = $model;
    }

    public function byUser(int $userId)
    {
        return $this->model->where('user_id', $userId)->paginate(9);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function findForUser(string $id, int $userId)
    {
        return $this->model->where('id', $id)->where('user_id', $userId)->firstOrFail();
    }

    public function updateForUser(array $data, string $id, int $userId)
    {
        $personagem = $this->findForUser($id, $userId);
        $personagem->update($data);
        return $personagem->fresh();
    }

    public function destroyForUser(string $id, int $userId)
    {
        $personagem = $this->findForUser($id, $userId);
        return $personagem->delete();
    }
}
