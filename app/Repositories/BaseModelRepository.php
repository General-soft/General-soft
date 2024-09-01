<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
abstract class BaseModelRepository
{
    /**
     * @var class-string<TModel>
     */
    protected string $model;

    public function create(array $data): Model
    {
        $newModel = $this->instantiateModel();

        $newModel->fill($data);

        $newModel->save();

        return $newModel;
    }

    /**
     * @return Builder<TModel>
     */
    protected function query(): Builder
    {
        return $this->instantiateModel()->newQuery();
    }

    protected function instantiateModel(): Model
    {
        return new $this->model;
    }
}
