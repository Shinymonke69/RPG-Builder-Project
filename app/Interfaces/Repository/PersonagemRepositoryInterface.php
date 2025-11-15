<?php

namespace App\Interfaces\Repository;

use App\Interfaces\Repository\RepositoryInterface;

interface PersonagemRepositoryInterface extends RepositoryInterface
{

    public function byUser($userId);
    public function findForUser($id, $userId);
    public function updateForUser(array $data, $id, $userId);
    public function destroyForUser($id, $userId);
}
