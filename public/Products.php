<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Application\ProductService;
use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator; 

session_start();

$filePath = __DIR__ . '/../storage/products.txt';

$repo = new FileProductRepository($filePath);
$validator = new SimpleProductValidator(); 

$service = new ProductService($repo, $validator);

$products = $service->list(); 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4">Lista de Produtos Cadastrados</h1>
        
        <p>
            <a href="index.php" class="btn btn-secondary">Voltar ao Cadastro</a>
        </p>

        <?php if (empty($products)): ?>
            <div class="alert alert-info" role="alert">
                Nenhum produto cadastrado até o momento.
            </div>
        <?php else: ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td>R$ <?= number_format($product['price'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>
</body>
</html>