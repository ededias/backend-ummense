<?php

namespace App\Modules\Users\Application\UseCases;

use App\Modules\Users\Application\DTO\UserDTO;
use App\Modules\Users\Domain\Entity\User;
use App\Modules\Users\Domain\Interfaces\UserInterface;

class FindByIdUseCase
{
   

    public function __construct(private UserInterface $userRepository)
    {
        
    }

    public function execute(int $id): ?UserDTO
    {
        $user = $this->userRepository->findById($id);
        return $user?->toDTO();
    }

}

