<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\ValidationRequestDTO;
use App\DTO\ValidationResultDTO;
use App\Models\User;
use App\Models\ValidationHistoryItem;
use App\Repositories\ValidationHistoryRepository;

class ValidationHistoryService
{
    public function __construct(
        private ValidationHistoryRepository $validationHistoryRepository
    ) {
        //
    }

    public function createHistoryItem(User $user, ValidationRequestDTO $validationRequest, ValidationResultDTO $validationResult): ValidationHistoryItem
    {
        return $this->validationHistoryRepository->create([
            'user_id' => $user->id,
            'file_type' => $validationRequest->getFileType(),
            'verification_result' => $validationResult->getResult(),
        ]);
    }
}
