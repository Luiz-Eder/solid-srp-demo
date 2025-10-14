<?php

declare(strict_types=1);

namespace App\Domain;

interface UserRepository
{
    /**
     * @param array{name:string,email:string,password:string} $user
     * @return bool
     */
    public function save(array $user): bool; 

    /**
     * @return array<int, array{name:string, email:string, password:string}>
     */
    public function findAll(): array;
}
