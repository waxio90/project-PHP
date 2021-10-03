<?php

declare(strict_types=1);

namespace App\Model;

interface AccountModelInterface
{
    public function listUserAd(int $id): array;

    public function editAd(array $data, int $idAd, int $idUser): void;

    public function deleteAd(int $idAd): void;

    public function getApp(int $idApp, int $idUser): array;

    public function getAdUser(int $id, int $idUser): array;

    public function deleteUser(int $id): void;

    public function deleteAdsUser(int $id): void;

    public function deleteApp(int $idApp): void;

    public function listUserApp(int $id): array;

    public function login(array $data): array;

    public function register(array $Data): void;

    public function changePassword(array $data, int $id): void;

    public function checkPassword(int $id): string;

    public function validateLogin(string $login): int;

    public function validateEmail(string $email): int;

    public function createAd(array $data, int $id): void;
}