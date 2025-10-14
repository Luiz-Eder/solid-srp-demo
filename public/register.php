<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Application\UserService;
use App\Domain\UserValidator;
use App\Infra\FileUserRepository;

$file = __DIR__ . '/../storage/users.txt';

$service = new UserService(new FileUserRepository($file), new UserValidator);

$response = $service->register($_POST);

$message = $response ? 'Usuário cadastrado com sucesso.' : 'Falha no cadastro.';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    
    <p>
        <?php if ($response): ?>
            <span style="color: green; font-weight: bold;"><?= htmlspecialchars($message) ?></span>
        <?php else: ?>
            <span style="color: red; font-weight: bold;"><?= htmlspecialchars($message) ?></span>
        <?php endif; ?>
    </p>

    <p>
        <a href="index.php">Fazer Novo Cadastro</a>
        |
        <a href="users.php">Ver Lista de Usuários</a>
    </p>

</body>
</html>
