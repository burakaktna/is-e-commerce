<?php

namespace App\Repository;

use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class AbstractBaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model::with($this->relations)->get();
    }

    public function find(int $id): array|Builder|\Illuminate\Database\Eloquent\Collection|Model
    {
        return $this->model::with($this->relations)->find($id);
    }

    public function create(array $attributes)
    {
        return $this->model::create($attributes);
    }

    public function update(int $id, array $attributes): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
    {
        $item = $this->find($id);
        if ($item) {
            $item->update($attributes);
            return $item;
        }
        return null;
    }

    public function delete(int $id)
    {
        $item = $this->find($id);
        if ($item) {
            return $item->delete();
        }
        return false;
    }
}
