<?php

namespace App\Modules\Users\Application\UseCases;

use App\Modules\Users\Application\DTO\UserDTO;
use App\Modules\Users\Domain\Entity\User;
use App\Modules\Users\Domain\Interfaces\UserInterface;

class GetAllUsersUseCase
{
    private UserInterface $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(): ?array
    {
        $data = $this->userRepository->getAll();
       
        return $this->hydrate($data);
    }

    /**
     * @return UserDTO[]
     * **/
    private function hydrate(array $data): array {
        if (empty($data)) {
            return [];
        }
        return collect($data)->map(fn(User $item): UserDTO => 
            $item->toDTO()
        )->toArray();
    }

}


