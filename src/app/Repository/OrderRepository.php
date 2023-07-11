<?php

namespace App\Repository;

use App\Models\Order;
use App\Repository\Contracts\OrderRepositoryInterface;

class OrderRepository extends AbstractBaseRepository implements OrderRepositoryInterface
{
    protected array $relations = ['customer', 'orderItems'];

    public function __construct(Order $model)
    {
        parent::__construct($model);
    }
}
