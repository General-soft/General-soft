<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModelRepository
{
    /**
     * @var class-string<Model>
     */
    protected $model;

    protected function query(): Builder
    {
        return $this->instantiateModel()->newQuery();
    }

    protected function instantiateModel(): Model
    {
        return new $this->model;
    }
}
