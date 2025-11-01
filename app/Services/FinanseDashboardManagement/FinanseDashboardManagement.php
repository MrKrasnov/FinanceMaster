<?php

namespace App\Services\FinanseDashboardManagement;

use App\Core\DB;
use App\Dto\Dashboard;
use App\Dto\User;
use App\Services\SQLQueryBuilder\InsertQueryBuilder;
use App\Services\SQLQueryBuilder\SelectQueryBuilder;
use Exception;
use PDO;
use PDOException;

class FinanseDashboardManagement
{
    private PDO $pdoDB;

    public function __construct()
    {
        $db = new DB();
        $this->pdoDB = $db->db;
    }

    public function findDashboardById(int $id): ?Dashboard
    {
        $selectSql = new SelectQueryBuilder();
        $selectSql
            ->select(['*'])
            ->from('boards')
            ->where(['id' => $id]);

        $result = $selectSql->execute($this->pdoDB);

        if (!empty($result)) {
            if(count($result) > 1) {
                //TODO: save log if dashboard record more than 1
            }

            return $this->convertArrayToDashboard($result[0]);
        }

        return null;
    }

    /**
     * @throws Exception
     */
    public function createDashboard(User $owner, string $title, string $description) : ?Dashboard
    {
        try {
            $this->pdoDB->beginTransaction();

            $dashboardId = $this->_createDashboard($title, $description);

            if($dashboardId === false) {
                throw new Exception("error write dashboard $title");
            }

            $memberId = $this->_createMember($dashboardId, $owner);

            if($memberId === false) {
                throw new Exception("error write members for dashboard $title");
            }

            $this->pdoDB->commit();
        } catch (PDOException|Exception $exception){
            if ($this->pdoDB->inTransaction()) {
                $this->pdoDB->rollBack();
            }

            //TODO: write in log
            throw new Exception($exception->getMessage());
        }

        return $this->findDashboardById($dashboardId);
    }


    private function convertArrayToDashboard(array $data): Dashboard
    {
        $dashboard = new Dashboard();
        if (isset($data['id'])) $dashboard->setId((string)$data['id']);
        if (isset($data['title'])) $dashboard->setTitle($data['title']);
        if (isset($data['description'])) $dashboard->setDescription($data['description']);
        if (isset($data['created_at'])) $dashboard->setCreatedAt($data['created_at']);
        if (isset($data['updated_at'])) $dashboard->setUpdatedAt($data['updated_at']);
        if (isset($data['deleted_at'])) $dashboard->setDeletedAt($data['deleted_at']);
        return $dashboard;
    }

    /**
     * @param string $dashboardId
     * @param User $owner
     * @return false|string
     */
    private function _createMember(string $dashboardId, User $owner): string|false
    {
        $insertSqlMember = new InsertQueryBuilder();

        $insertSqlMember
            ->insertInto('members')
            ->setValues([
                'boards_id' => $dashboardId,
                'user_id' => $owner->getId(),
                'role_id' => 1
            ]);

        $result = $insertSqlMember->execute($this->pdoDB);
        $memberId = $this->pdoDB->lastInsertId();
        return $memberId;
    }

    /**
     * @param string $title
     * @param string $description
     * @return false|string
     */
    private function _createDashboard(string $title, string $description): string|false
    {
        $insertSqlDashboard = new InsertQueryBuilder();

        $insertSqlDashboard
            ->insertInto('boards')
            ->setValues([
                'title' => $title,
                'description' => $description,
            ]);

        $result = $insertSqlDashboard->execute($this->pdoDB);
        $dashboardId = $this->pdoDB->lastInsertId();
        return $dashboardId;
    }
}