<?php

namespace App\Modules\Users\Infrastructure\Repository;

use App\Modules\Users\Domain\Exceptions\Exceptions;
use App\Modules\Users\Domain\Interfaces\UserInterface;

class UserRepository implements UserInterface {
    public function get(): array {
        throw new Exceptions('method not implemented');
    }

    public function getAll(): array {
        throw new Exceptions('method not implemented');
    }

    public function edit(): bool {
        throw new Exceptions('method not implemented');
    }

    public function delete(): bool {
        throw new Exceptions('method not implemented');
    }

}