<?php

namespace App\Repository;

use App\Models\Customer;
use App\Repository\Contracts\CustomerRepositoryInterface;

class CustomerRepository extends AbstractBaseRepository implements CustomerRepositoryInterface
{
    protected array $relations = ['orders'];

    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }
}
