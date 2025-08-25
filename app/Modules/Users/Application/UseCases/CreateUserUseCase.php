<?php

namespace App\Modules\Users\Application\UseCases;

use App\Modules\Users\Application\DTO\UserDTO;
use App\Modules\Users\Domain\Entity\User;
use App\Modules\Users\Domain\Interfaces\UserInterface;

class CreateUserUseCase
{
   

    public function __construct(private UserInterface $userRepository)
    {
        
    }

    public function execute(UserDTO $userDTO): ?bool
    {
        $created = $this->userRepository->create($userDTO);
        return $created;
    } 

}

