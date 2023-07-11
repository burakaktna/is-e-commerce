<?php

namespace App\Repository;

use App\Models\OrderItem;
use App\Repository\Contracts\OrderItemRepositoryInterface;

class OrderItemRepository extends AbstractBaseRepository implements OrderItemRepositoryInterface
{
    protected array $relations = ['order', 'product'];

    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }
}
