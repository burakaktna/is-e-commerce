<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repository\Contracts\CustomerRepositoryInterface;
use App\Repository\Contracts\OrderItemRepositoryInterface;
use App\Repository\Contracts\OrderRepositoryInterface;
use App\Repository\Contracts\ProductRepositoryInterface;
use App\Repository\CustomerRepository;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private array $repositories = [
        Product::class => [
            'repository' => ProductRepository::class,
            'interface' => ProductRepositoryInterface::class
        ],
        Customer::class => [
            'repository' => CustomerRepository::class,
            'interface' => CustomerRepositoryInterface::class
        ],
        Order::class => [
            'repository' => OrderRepository::class,
            'interface' => OrderRepositoryInterface::class
        ],
        OrderItem::class => [
            'repository' => OrderItemRepository::class,
            'interface' => OrderItemRepositoryInterface::class
        ],
    ];

    public function register(): void
    {
        foreach ($this->repositories as $model => $repository) {
            $this->app->singleton($repository['interface'], function () use ($model, $repository) {
                return new $repository['repository'](new $model());
            });
        }
    }
}
