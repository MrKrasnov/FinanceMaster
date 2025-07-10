<?php

namespace App\Services\UserManagement;

use App\Core\DB;
use App\Dto\User;
use App\Services\SQLQueryBuilder\InsertQueryBuilder;
use App\Services\SQLQueryBuilder\SelectQueryBuilder;
use DomainException;
use PDO;

class UserManagement
{
    private PDO $pdoDB;
    
    public function __construct()
    {
        $db = new DB();
        $this->pdoDB = $db->db;
    }

    /**
     * @throws DomainException
     */
    public function registration(string $login, string $email, string $password) : ?User
    {
        if($this->checkUserByEmail($email)) {
            throw new DomainException("User with this email already exists.", 409);
        }

        throw new \Exception("dasdas");

        $sqlstring = new InsertQueryBuilder();
        $sqlstring
            ->insertInto('users')
            ->setValues([
                'login' => $login,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ])->execute($this->pdoDB);

        return $this->findUserByEmail($email);
    }

    public function findUserByEmail(string $email): ?User
    {
        $selectSql = new SelectQueryBuilder();
        $selectSql
            ->select(['*'])
            ->from('users')
            ->where(['email' => $email]);

        $result = $selectSql->execute($this->pdoDB);

        if (!empty($result)) {
            return $this->convertArrayToUser($result[0]);
        }

        return null;
    }

    private function checkUserByEmail($email) : Bool
    {
        $selectSql = new SelectQueryBuilder();
        $selectSql
            ->select(['email'])
            ->from('users')
            ->where(['email'=> $email]);

        $result = $selectSql->execute($this->pdoDB);
        return !empty($result);
    }

    private function convertArrayToUser(array $data): User
    {
        $user = new User();
        if (isset($data['id'])) $user->setId((string)$data['id']);
        if (isset($data['email'])) $user->setEmail($data['email']);
        if (isset($data['login'])) $user->setLogin($data['login']);
        if (isset($data['password'])) $user->setPassword($data['password']);
        if (isset($data['created_at'])) $user->setCreatedAt($data['created_at']);
        if (isset($data['updated_at'])) $user->setUpdatedAt($data['updated_at']);
        return $user;
    }
}