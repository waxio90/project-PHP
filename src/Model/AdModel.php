<?php

declare(strict_types=1);

namespace App\Model;

use App\Exception\StorageException;
use App\Exception\NotFoundException;
use PDO;
use Throwable;

class AdModel extends AccountModel implements AdModelInterface
{
    public function applyAd(array $params, string $file): void
    {
        try {
            $idOffer = $this->conn->quote($params['idOffer']);
            $idUser = $this->conn->quote($params['idUser']);
            $name = $this->conn->quote($params['name']);
            $lastName = $this->conn->quote($params['lastName']);
            $email = $this->conn->quote($params['email']);
            $phone = $this->conn->quote($params['phone']);
            $sended = $this->conn->quote(date('Y-m-d H:i:s'));
            $nameFile = $this->conn->quote($file);
            
            $query = "
                INSERT INTO apply_offers(id_offer, id_user, name, last_name, email, phone, sended, cv)
                VALUES($idOffer, $idUser, $name, $lastName, $email, $phone, $sended, $nameFile)
            ";
            $this->conn->exec($query);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd rejestracji użytkownika', 400, $e);
        }
    }
    
    public function getAd(int $id): array
    {
        try {
            $query = "SELECT * FROM offers WHERE id = $id";
            $result = $this->conn->query($query);
            $ad = $result->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd pobierania ogłoszenia', 400, $e);
        }
        
        if (!$ad) {
            throw new NotFoundException("Ogłoszenie o id: $id nie istnieje");
            exit('nie ma takiego ogłoszenia');
        }
        
        return $ad;
    }
    
    public function search(string $phrase) : array
    {
        try {
            $phrase = $this->conn->quote('%' . $phrase . '%', PDO::PARAM_STR);
            
            $query = "
                SELECT *
                FROM offers
                WHERE position LIKE ($phrase) OR locationCompany LIKE ($phrase)
                ORDER BY created desc
            ";
            $result = $this->conn->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd pobierania danych', 400, $e);
        }
    }
    
    public function getAdOffers(): array
    {
        try {
            $query = "
                SELECT id, title, company, locationCompany, position, salaryFrom, salaryTo, salary, currency, locationJob, created, level, contract
                FROM offers
                ORDER BY created desc
            ";
            $result = $this->conn->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd pobierania danych', 400, $e);
        }
    }

    public function getCounter(int $id): int
    {
        try {
            $query = "SELECT counter FROM offers WHERE id = $id";
            $result = $this->conn->query($query);
            return (int) $result->fetch()['counter'];
        } catch (\Throwable $e) {
            throw new StorageException('Błąd pobierania danych', 400, $e);
        }
    }
    
    public function updateCounter(int $counter, int $id): void
    {
        try {
            $query = "UPDATE offers SET counter = $counter WHERE id = $id";
            $this->conn->exec($query);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd aktualizacji danych', 400, $e);
        }
    }
}