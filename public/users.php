<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Application\ListUsersService;
use App\Infra\FileUserRepository;

// --- 1. Inicialização das Camadas ---
$file = __DIR__ . '/../storage/users.txt';
$userRepository = new FileUserRepository($file);
$listUsersService = new ListUsersService($userRepository);

// --- 2. Chamada ao Serviço (Camada de Aplicação) ---
$users = $listUsersService->execute(); 

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Usuários</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Lista de Usuários Cadastrados</h1>

    <p><a href="index.php">Voltar para o Cadastro</a></p>

    <?php if (empty($users)): ?>
        <p style="color: gray;">Não há usuários cadastrados no momento.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['name'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($user['email'] ?? 'N/A') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
</body>
</html>
