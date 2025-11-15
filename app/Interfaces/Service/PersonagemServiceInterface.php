<?php

namespace App\Interfaces\Service;

use App\Interfaces\Service\ServiceInterface;

interface PersonagemServiceInterface extends ServiceInterface
{

    public function index($userId);
    public function store(array $data, $userId);
    public function show($id, $userId);
    public function update($id, array $attributes, $userId = null);
    public function destroy($id, $userId);
    public function generatePersonagemData();
}
