<?php

declare(strict_types=1);

namespace App\DTO\GoogleDns;

class LookupResponseDTO
{
    /**
     * @param  string[]  $answers
     */
    public function __construct(
        private int $status,
        private array $answers
    ) {
        //
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string[]
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }
}
