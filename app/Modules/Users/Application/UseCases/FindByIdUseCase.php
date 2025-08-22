<?php

namespace App\Modules\Users\Application\UseCases;

use App\Modules\Users\Domain\Entity\User;
use App\Modules\Users\Domain\Interfaces\UserInterface;

class FindByIdUseCase
{
   

    public function __construct(private UserInterface $userRepository)
    {
        
    }

    public function execute(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }
}

