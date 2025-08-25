<?php

namespace App\Modules\Users\Application\UseCases;

use App\Modules\Users\Domain\Interfaces\UserInterface;

class DeleteUserUseCase {
    public function __construct(
        private UserInterface $userRepository
    ) {}

    public function execute(int $id): bool {
        return $this->userRepository->delete($id);
    }
}