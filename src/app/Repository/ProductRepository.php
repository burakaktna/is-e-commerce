<?php

namespace App\Repository;

use App\Models\Product;
use App\Repository\Contracts\ProductRepositoryInterface;

class ProductRepository extends AbstractBaseRepository implements ProductRepositoryInterface
{
    protected array $relations = ['orderItems'];

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
