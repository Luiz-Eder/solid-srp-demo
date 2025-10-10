<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Infra\FileUserRepository;
use App\Application\ListUsersService;

$storagePath = __DIR__ . '/../storage/users.txt'; 

$userRepository = new FileUserRepository($storagePath); 
$listService = new ListUsersService($userRepository); 
$users = $listService->execute(); 

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Usuários</title>
</head>
<body>
    <h1>Listagem de Usuários</h1>
    
    <p>
        <a href="register.php">← Novo Cadastro</a>
    </p>

    <?php if (empty($users)): ?>
        <p>Nenhum usuário cadastrado até o momento.</p>
    <?php else: ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($users as $user): 
                ?>
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