<?php

declare(strict_types=1);

namespace App\Facades\FileValidator;

use App\DTO\ValidationRequestDTO;
use App\DTO\ValidationResultDTO;
use App\Factories\FileValidationFactory;
use App\Models\User;
use App\Services\ValidationHistoryService;

class FileValidator
{
    public function __construct(
        private FileValidationFactory $fileValidationFactory,
        private ValidationHistoryService $validationHistoryService,
    ) {
        //
    }

    public function validate(User $user, ValidationRequestDTO $validationRequest): ValidationResultDTO
    {
        $fileValidationService = $this->fileValidationFactory->validationService($validationRequest->getFileType());
        $validationResult = $fileValidationService->validateFileRequest($validationRequest);

        $this->validationHistoryService->createHistoryItem($user, $validationRequest, $validationResult);

        return $validationResult;
    }
}
