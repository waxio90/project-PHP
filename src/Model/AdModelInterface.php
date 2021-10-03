<?php

declare(strict_types=1);

namespace App\Model;

interface AdModelInterface
{
    public function applyAd(array $params, string $file): void;

    public function getAd(int $id): array;

    public function search(string $phrase) : array;

    public function getAdOffers(): array;

    public function getCounter(int $id): int;

    public function updateCounter(int $counter, int $id): void;
}