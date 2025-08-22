<?php

namespace App\Modules\Users\Domain\Interfaces;

use App\Modules\Users\Domain\Entity\User;

interface UserInterface
{
    public function findById(int $id): ?User;

    /**
     * @return User[]
     **/
    public function getAll(): ?array;

    public function edit(int $id,  User $data): bool;

    public function delete(int $id): bool;

}