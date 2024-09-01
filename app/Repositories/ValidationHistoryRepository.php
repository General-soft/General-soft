<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ValidationHistoryItem;

/**
 * @extends BaseModelRepository<ValidationHistory>
 */
class ValidationHistoryRepository extends BaseModelRepository
{
    protected string $model = ValidationHistoryItem::class;
}
