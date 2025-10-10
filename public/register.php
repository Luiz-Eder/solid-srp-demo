<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Application\UserService;
use App\Domain\UserValidator;
use App\Infra\FileUserRepository;

$file = __DIR__ . '/../storage/users.txt';
$userRepository = new FileUserRepository($file);
$userValidator = new UserValidator(); 
$userService = new UserService($userRepository, $userValidator);

$message = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = $userService->register($_POST);
    
    if ($response['success']) {
        header('Location: users.php'); 
        exit;
    } else {
        $message = 'Falha no cadastro.';
        $errors = $response['errors'] ?? []; 
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>
</head>
<body>
    <h1>Cadastro de Usuários</h1>

    <?php if (!empty($message) && empty($errors)): ?>
        <p style="color: green; font-weight: bold;">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php elseif (!empty($errors)): ?>
        <p style="color: red; font-weight: bold;">
            <?= htmlspecialchars($message) ?> Detalhes:
        </p>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST">
        Nome: <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required><br><br>
        E-mail: <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required><br><br>
        Senha: <input type="password" name="password" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>
    
    <p><a href="users.php">Ver Listagem de Usuários</a></p>

</body>
</html>