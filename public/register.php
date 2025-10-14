<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Application\UserService;
use App\Domain\UserValidator;
use App\Infra\FileUserRepository;

$file = __DIR__ . '/../storage/users.txt';

$service = new UserService(new FileUserRepository($file), new UserValidator);

$response = []; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = $service->register($_POST);
}

$isSuccess = $response['success'] ?? false;
$errors = $response['errors'] ?? [];

$httpCode = $isSuccess ? 201 : 422;
http_response_code($httpCode);

$message = $isSuccess ? 'Usuário cadastrado com sucesso.' : 'Falha no cadastro. Detalhes:';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado do Cadastro</title>
</head>
<body>
    
    <p>
        <?php if ($isSuccess): ?>
            <span style="color: green; font-weight: bold;"><?= htmlspecialchars($message) ?></span>
        <?php else: ?>
            <span style="color: red; font-weight: bold;"><?= htmlspecialchars($message) ?></span>
            
            <?php if (!empty($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li style="color: red;"><?= htmlspecialchars((string)$error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
    </p>

    <p>
        <a href="index.php">Fazer Novo Cadastro</a>
        |
        <a href="users.php">Ver Lista de Usuários</a>
    </p>

</body>
</html>
