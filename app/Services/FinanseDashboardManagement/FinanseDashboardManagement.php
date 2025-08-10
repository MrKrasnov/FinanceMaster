<?php

namespace App\Services\FinanseDashboardManagement;

use App\Core\DB;
use App\Dto\Dashboard;
use App\Dto\User;
use PDO;

class FinanseDashboardManagement
{
    private PDO $pdoDB;

    public function __construct()
    {
        $db = new DB();
        $this->pdoDB = $db->db;
    }

    public function createDashboard(User $owner, $title, $description) : ?Dashboard
    {
        //TODO: create dashboard

        return null;
    }
}