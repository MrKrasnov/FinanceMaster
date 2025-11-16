<?php

namespace App\Core;

use PDO;

class Management
{
    protected PDO $pdoDB;

    public function __construct(?PDO $paramPDO = null)
    {
        if(isset($paramPDO)) {
            $this->pdoDB = $paramPDO;
        } else {
            $db = new DB();
            $this->pdoDB = $db->db;
        }
    }
}