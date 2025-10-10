<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\UserRepository;
use App\Domain\UserValidator;

final class UserService
{
    private UserRepository $repository;
    private UserValidator $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array{name:string, email:string, password:string} $userData
     * @return array{success:bool, errors?:array<string>} 
     */
    public function register(array $userData): array
    {
        $errors = $this->validator->validate($userData);

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $this->repository->save($userData);
        
        return ['success' => true];
    }
}