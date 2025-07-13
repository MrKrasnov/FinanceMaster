<?php

namespace App\Core;

use PDO;
use PDOException;

class DB
{
    public PDO $db;

    public function __construct()
    {
        try {
            $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8';
            $this->db = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
        } catch (PDOException $error) {
            die(Log::writeLog("Подключение не удалось: {$error->getMessage()}"));
        } catch (\Throwable $error){
            die(Log::writeLog("Неожиданная ошибка: {$error->getMessage()}"));
        }
    }
}