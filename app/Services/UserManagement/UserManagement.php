<?php

namespace App\Services\UserManagement;

use App\Core\Management;
use App\Core\Manager\SessionTokenManager;
use App\Dto\User;
use App\Services\SQLQueryBuilder\InsertQueryBuilder;
use App\Services\SQLQueryBuilder\SelectQueryBuilder;
use DomainException;

class UserManagement extends Management
{
    public function logout(): void
    {
        //Note: in future we will use cookie for auth 
        $session = new SessionTokenManager();
        $session->logout();
    }

    /**
     * @throws DomainException
     */
    public function login(string $username, string $password) : bool
    {
        $userRecord = $this->findUserByUsername($username);

        if(!isset($userRecord)) {
            throw new DomainException("User with this username not exists.", 409);
        }

        if(!password_verify($password, $userRecord->getPassword())) {
            throw new DomainException("Invalid password.", 401);
        }

        //NOTE: in future we will use cookie for auth
        $session = new SessionTokenManager();
        $session->login($userRecord->getId(), $userRecord->getLogin());
        return true;
    }

    /**
     * @throws DomainException
     */
    public function registration(string $login, string $email, string $password) : ?User
    {
        if($this->checkUserByEmail($email)) {
            throw new DomainException("User with this email already exists.", 409);
        }

        if($this->checkUserByLogin($login)) {
            throw new DomainException("User with this login already exists.", 409);
        }

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

    public function findUserByUsername(string $username) : ?User
    {
        $userRecord = null;
        if(str_contains($username, '@')) {
            $userRecord = $this->findUserByEmail($username);
        }

        if(!isset($userRecord)) {
            $userRecord = $this->findUserByLogin($username);
        }

        if(!isset($userRecord) && !str_contains($username, '@')) {
            $userRecord = $this->findUserByEmail($username);
        }

        return $userRecord;
    }

    public function findUserByLogin(string $login) : ?User
    {
        $selectSql = new SelectQueryBuilder();
        $selectSql
            ->select(['*'])
            ->from('users')
            ->where(['login' => $login]);

        $result = $selectSql->execute($this->pdoDB);

        if (!empty($result)) {
            if(count($result) > 1) {
                //TODO: save log if user record more than 1
            }

            return $this->convertArrayToUser($result[0]);
        }

        return null;
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
            if(count($result) > 1) {
                //TODO: save log if user record more than 1
            }

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

    private function checkUserByLogin($login) : Bool
    {
        $selectSql = new SelectQueryBuilder();
        $selectSql
            ->select(['login'])
            ->from('users')
            ->where(['login'=> $login]);

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