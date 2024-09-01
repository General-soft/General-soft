<?php

declare(strict_types=1);

namespace App\Services\FileValidator\IssuerDataHasher;

use Arr;

class Sha256IssuerDataFileHasher implements IssuerFileDataHasher
{
    public function hashFileData(array $data): string
    {
        $dataDotNotation = $this->transformToDotNotation($data);

        $hashesPerDocumentLine = [];
        foreach ($dataDotNotation as $key => $value) {
            $hashesPerDocumentLine[] = $this->hashArray([$key => $value]);
        }

        $hashesPerDocumentLine = array_values(Arr::sort($hashesPerDocumentLine));

        return $this->hashArray($hashesPerDocumentLine);
    }

    private function transformToDotNotation(array $data): array
    {
        return Arr::dot($data);
    }

    private function hashArray(array $data): string
    {
        return hash('sha256', json_encode($data));
    }
}
