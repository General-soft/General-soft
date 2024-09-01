<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\FileType;
use Illuminate\Database\Eloquent\Model;

class ValidationHistoryItem extends Model
{
    protected $table = 'validation_history_item';

    protected $fillable = [
        'user_id',
        'file_type',
        'verification_result',
    ];

    protected function casts(): array
    {
        return [
            'file_type' => FileType::class,
        ];
    }
}
