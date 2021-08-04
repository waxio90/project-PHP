<?php


declare(strict_types=1);

namespace App;

use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use App\Exception\NotFoundException;
use PDO;
use PDOException;

class Database 
{
    private PDO $conn;
    
    public function __construct(array $config)
    {
        try {
            $this->validateConfig($config);
            $this->createConnection($config);
        } catch (PDOException $e) {
            throw new StorageException('Connection error');
        }
    }
    
    public function listUserAd($id): array
    {
        try {
            $idUser = $this->conn->quote($id);
            
            $query = "SELECT id, title, created, counter FROM offers WHERE id_user = $idUser";
            $result = $this->conn->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd pobierania danych', 400, $e);
        }
    }
    
    public function editAd($data, int $idAd, int $idUser)
    {
        try {
            $company = $this->conn->quote($data['company']);
            $locationCompany = $this->conn->quote($data['locationCompany']);
            $descriptionCompany = $this->conn->quote($data['descriptionCompany']);
            $title = $this->conn->quote($data['title']);
            $position = $this->conn->quote($data['position']);
            $level = $this->conn->quote($data['level']);
            $contract = $this->conn->quote($data['contract']);
            $locationJob = $this->conn->quote($data['locationJob']);
            $salaryFrom = $this->conn->quote($data['salaryFrom']);
            $salaryTo = $this->conn->quote($data['salaryTo']);
            $salary = $this->conn->quote($data['salary']);
            $currency = $this->conn->quote($data['currency']);
            $descriptionNeeds = $this->conn->quote($data['descriptionNeeds']);
            
            $query = "
                UPDATE offers
                SET
                    company = $company,
                    locationCompany = $locationCompany,
                    descriptionCompany = $descriptionCompany,
                    title = $title,
                    position = $position,
                    level = $level,
                    contract = $contract,
                    locationJob = $locationJob,
                    salaryFrom = $salaryFrom,
                    salaryTo = $salaryTo,
                    salary = $salary,
                    currency = $currency,
                    descriptionNeeds = $descriptionNeeds
                WHERE id = $idAd AND id_user = $idUser    
            ";
            
            $this->conn->exec($query);
        } catch (\Throwable $e) {
            throw new StorageException('Nie udało się zaktualizować ogłoszenia', 400, $e);
        }
    }
    
    public function deleteAd(int $idAd, int $idUser): void
    {
        try {
            $query = "
                DELETE a,b
                FROM offers a
                LEFT JOIN apply_offers b
                ON b.id_offer = a.id
                WHERE a.id = $idAd";
                
            $this->conn->exec($query);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd usuwania danych', 400, $e);
        }
    }
    
    public function getApp(int $idApp, int $idUser): array
    {
        try {
            $query = "SELECT * FROM apply_offers WHERE id = $idApp AND id_user = $idUser";
            $result = $this->conn->query($query);
            $app = $result->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd pobierania danych', 400, $e);
        }
        
        if (!$app) {
            header('location: /?action=listUserApp&error=notFound');
        }
        
        return $app;
    }
    
    public function getAdUser(int $id, int $idUser): array
    {
        try {
            $query = "SELECT * FROM offers WHERE id = $id AND id_user = $idUser";
            $result = $this->conn->query($query);
            $ad = $result->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd pobierania ogłoszenia', 400, $e);
        }
        
        if (!$ad) {
            header('location: /?action=listUserAd&error=notFound');
        }
        
        return $ad;
    }
    
    public function deleteUser(int $id): void
    {
        try {
            $query = "DELETE FROM account_users WHERE id = $id LIMIT 1";
            $this->conn->exec($query);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd usuwania danych', 400, $e);
        }
    }
    
    public function deleteAdsUser(int $id): void
    {
        try {
            $query = "
                DELETE a,b
                FROM offers a
                LEFT JOIN apply_offers b
                ON b.id_user = a.id_user
                WHERE a.id_user = $id";
            
            $this->conn->exec($query);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd usuwania danych', 400, $e);
        }
    }
    
    public function deleteApp(int $idApp): void
    {
        try {
            $query = "DELETE FROM apply_offers WHERE id = $idApp LIMIT 1";
            $this->conn->exec($query);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd usuwania danych', 400, $e);
        }
    }
    
    public function listUserApp($id): array
    {
        try {
            $idUser = $this->conn->quote($id);
            
            $query = "
                SELECT apply_offers.id, apply_offers.id_offer, apply_offers.name, apply_offers.last_name, apply_offers.sended, apply_offers.cv, offers.title 
                FROM apply_offers 
                INNER JOIN offers
                ON apply_offers.id_offer=offers.id
                AND apply_offers.id_user=$idUser";
            $result = $this->conn->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd pobierania danych', 400, $e);
        }
    }
    
    public function login(array $data)
    {
        try {
            $login = $this->conn->quote($data['login']);
    
            $query = "SELECT id, login, password FROM account_users WHERE login = $login";
            $result = $this->conn->query($query);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd podczas logowania', 400, $e);
        }
    }
    
    public function register(array $Data): void
    {
        try {
            $login = $this->conn->quote($Data['login']);
            $password = $this->conn->quote(password_hash($Data['password'], PASSWORD_DEFAULT));
            $email = $this->conn->quote($Data['email']);

            $query = "
                INSERT INTO account_users(login, password, email)
                VALUES($login, $password, $email)
            ";
            $this->conn->exec($query);
            Header('Location: /?action=login');   
        } catch (\Throwable $e) {
            throw new StorageException('Błąd rejestracji użytkownika', 400, $e);
        }
    }
    
    public function changePassword(array $data, int $id)
    {
        try {
            $newPassword = $this->conn->quote(password_hash($data['newPassword'], PASSWORD_DEFAULT));
            
            $query = "UPDATE account_users SET password = $newPassword WHERE id = $id";
            $this->conn->exec($query);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd pobierania danych');
        }
    }
    
    public function checkPassword(int $id)
    {
        try {
            $query = "SELECT password FROM account_users WHERE id = $id";
            $result = $this->conn->query($query);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            throw new StorageException('Błąd pobierania danych');
        }
    }
    
    public function validateLogin(string $login)
    {
        $vlogin = $this->conn->quote($login);
        $query = "SELECT id FROM account_users WHERE login = $vlogin";
        $result = $this->conn->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    
    public function validateEmail(string $email)
    {
        $vemail = $this->conn->quote($email);
        $query = "SELECT id FROM account_users WHERE email = $vemail";
        $result = $this->conn->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
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
    
    public function createAd(array $data, $id): void
    {
        try {
            $idUser = $this->conn->quote($id);
            $created = $this->conn->quote(date('Y-m-d H:i:s'));
            $company = $this->conn->quote($data['company']);
            $locationCompany = $this->conn->quote($data['locationCompany']);
            $descriptionCompany = $this->conn->quote($data['descriptionCompany']);
            $title = $this->conn->quote($data['title']);
            $position = $this->conn->quote($data['position']);
            $level = $this->conn->quote($data['level']);
            $contract = $this->conn->quote($data['contract']);
            $locationJob = $this->conn->quote($data['locationJob']);
            $salaryFrom = $this->conn->quote($data['salaryFrom']);
            $salaryTo = $this->conn->quote($data['salaryTo']);
            $salary = $this->conn->quote($data['salary']);
            $currency = $this->conn->quote($data['currency']);
            $descriptionNeeds = $this->conn->quote($data['descriptionNeeds']);
            
            $query = "
                INSERT INTO offers(
                                    created, 
                                    id_user,
                                    company, 
                                    locationCompany,  
                                    descriptionCompany, 
                                    title, 
                                    position, 
                                    level, 
                                    contract,
                                    locationJob,
                                    salaryFrom, 
                                    salaryTo, 
                                    salary,
                                    currency, 
                                    descriptionNeeds
                                )
                VALUES(
                        $created, 
                        $idUser,
                        $company, 
                        $locationCompany,  
                        $descriptionCompany, 
                        $title, 
                        $position, 
                        $level,  
                        $contract,
                        $locationJob,
                        $salaryFrom, 
                        $salaryTo, 
                        $salary,
                        $currency,
                        $descriptionNeeds 
                    )
            ";    
            $this->conn->exec($query);
        } catch (\Throwable $e) {
            throw new StorageException('Nie udało się utworzyć nowego ogłoszenia', 400, $e);
        }
                
    }
    
    private function createConnection(array $config): void
    {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        $this->conn = new PDO(
            $dsn,
            $config['user'],
            $config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
            );
    }
    
    private function validateConfig(array $config): void
    {
        if (
            empty($config['database'])
            || empty($config['host'])
            || empty($config['user'])
            || empty($config['password'])
            ) {
                throw new ConfigurationException('Storage configuration error');
            }
    }
}