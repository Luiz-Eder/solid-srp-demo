<?php

namespace App\Application;

use App\Contracts\ProductRepository;
use App\Contracts\ProductValidator;

class ProductService
{
    /**
     * @return array
     */
    public function list(): array
    {
        return $this->repository->findAll();
    }
}