<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\UserRepository; 

final class ListUsersService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return array<int, array{name:string, email:string, password:string}>
     */
    public function execute(): array
    {
        return $this->userRepository->findAll();
    }
}