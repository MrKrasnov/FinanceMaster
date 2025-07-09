<?php

namespace App\Services\UserManagement;

use App\Core\DB;
use App\Services\SQLQueryBuilder\InsertQueryBuilder;
use App\Services\SQLQueryBuilder\SelectQueryBuilder;
use PDO;

class UserManagement
{
    private PDO $pdoDB;
    
    public function __construct()
    {
        $db = new DB();
        $this->pdoDB = $db->db;
    }

    public function registration(string $login, string $email, string $password)
    {
        if($this->checkUserByEmail($email)) {
            return;
        }

        $sqlstring = new InsertQueryBuilder();
        $sqlstring
            ->insertInto('users')
            ->setValues([
                'login' => $login,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ])->execute($this->pdoDB);


        
    }

    private function checkUserByEmail($email) : Bool
    {
        $selectSql = new SelectQueryBuilder();
        $selectSql
            ->select(['email'])
            ->from('users')
            ->where(['email'=> $email]);

        $result = $selectSql->execute($this->pdoDB);
        return empty($result);
    }
}