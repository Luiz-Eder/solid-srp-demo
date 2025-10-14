<?php

declare(strict_types=1);

namespace App\Domain;

interface UserRepository
{
    /**
     * @param array{name:string,email:string,password:string} $user
     * @return bool Retorna TRUE se o salvamento for bem-sucedido, FALSE caso contrário.
     */
    public function save(array $user): bool; // CORRIGIDO: de : void para : bool

    /**
     * @return array<int, array{name:string, email:string, password:string}>
     */
    public function findAll(): array;
}
