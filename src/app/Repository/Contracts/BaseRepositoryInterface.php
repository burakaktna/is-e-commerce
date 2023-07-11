<?php

namespace App\Repository\Contracts;

use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id);

    public function create(array $attributes);

    public function update(int $id, array $attributes);

    public function delete(int $id);
}
