<?php

namespace App\Modules\Users\Domain\Interfaces;

interface UserInterface
{
    public function get(): array;

    public function getAll(): array;

    public function edit(): bool;

    public function delete(): bool;

}