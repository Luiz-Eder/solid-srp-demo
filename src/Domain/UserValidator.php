<?php

declare(strict_types=1);

namespace App\Domain;

final class UserValidator
{
    /**
     * @param array{name:string, email:string, password:string} $user
     * @return array<string> 
     */
    public function validate(array $user): array
    {
        $errors = [];

        if (empty($user['name'])) {
            $errors[] = 'O nome é obrigatório.';
        }
        
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
             $errors[] = 'O formato do e-mail é inválido.';
        }

        $password = $user['password'] ?? '';
        
        if (strlen($password) < 8) { 
            $errors[] = 'A senha deve ter no mínimo 8 caracteres.';
        }
        
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = 'A senha deve incluir pelo menos uma letra maiúscula.';
        }
        
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = 'A senha deve incluir pelo menos um número.';
        }
        
        return $errors;
    }
}