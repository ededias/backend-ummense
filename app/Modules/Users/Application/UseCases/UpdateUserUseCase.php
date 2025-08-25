<?php

namespace App\Modules\Users\Application\UseCases;

use App\Modules\Users\Application\DTO\UserDTO;
use App\Modules\Users\Domain\Interfaces\UserInterface;

class UpdateUserUseCase {
    public function __construct(
        private UserInterface $userRepository
    ) {}

    public function execute(UserDTO $user, int $id): bool {
       
        return $this->userRepository->update(id: $id, data: $user);
    }
}