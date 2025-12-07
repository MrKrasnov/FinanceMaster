<?php

namespace App\Services\FinanseDashboardManagement;

use App\Core\Enum\TypeRecord;
use App\Core\Enum\UserRole;
use App\Core\Log;
use App\Core\Management;
use App\Dto\CreateCategory;
use App\Dto\CreateDashboard;
use App\Dto\Dashboard;
use App\Dto\User;
use App\Services\FinanceCategoryManagement\FinanceCategoryManagement;
use App\Services\SQLQueryBuilder\InsertQueryBuilder;
use App\Services\SQLQueryBuilder\SelectQueryBuilder;
use DomainException;
use Exception;
use PDOException;

class FinanceDashboardManagement extends Management
{
    public function findRoleUser(int $userId, int $dashboardId) : UserRole
    {
        $selectSqlMember = new SelectQueryBuilder();
        $selectSqlMember
            ->select(["members.role_id"])
            ->from("members")
            ->where(["user_id" => $userId, "board_id" => $dashboardId]);

        $result = $selectSqlMember->execute($this->pdoDB);

        if(count($result) > 1) {
            Log::writeLog("Found role user more than one in findRoleUser. Check userID $userId");
        }

        if(empty($result)) {
            $messageError = 'UserId ' . $userId . ' don`t found role for dashboardId ' . $dashboardId;
            Log::writeLog($messageError);
            throw new DomainException($messageError, 500);
        }

        return UserRole::from($result[0]['role_id']);
    }

    /**
     * @param int $userId
     * @return array<Dashboard>|null
     */
    public function findDashboardsByUserId(int $userId): array
    {
        $selectSqlMember = new SelectQueryBuilder();

        $selectSqlMember
            ->select(["members.board_id"])
            ->from("members")
            ->where(["user_id" => $userId]);

        $boardsId = $selectSqlMember->execute($this->pdoDB);

        $board_ids = [];
        foreach ($boardsId as $boardId) {
            $board_id = $boardId['board_id'];
            $board_ids[] = $board_id;
        }

        $board_ids = array_unique($board_ids);

        if(empty($board_ids)) {
            return [];
        }

        return $this->findDashboardByIds($board_ids);
    }

    /**
     * @param array $ids
     * @return array<Dashboard>
     */
    public function findDashboardByIds(array $ids): array
    {
        $selectSql = new SelectQueryBuilder();
        $selectSql
            ->select(['*'])
            ->from('boards');

        foreach ($ids as $id) {
            $selectSql->where(['id' => $id]);
        }

        $results = $selectSql->execute($this->pdoDB);

        if (!empty($results)) {
            $resultDashboards = [];

            foreach ($results as $result) {
                $resultDashboards[] = $this->convertArrayToDashboard($result);
            }

            return $resultDashboards;
        }

        return [];
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
                Log::writeLog("Found dashbord more than one in findDashboardById. Check id $id");
            }

            return $this->convertArrayToDashboard($result[0]);
        }

        return null;
    }

    /**
     * @throws Exception
     */
    public function createDashboard(CreateDashboard $createDashboard) : ?Dashboard
    {
        try {
            $this->pdoDB->beginTransaction();

            $dashboardId = $this->_createDashboard($createDashboard);

            if($dashboardId === false) {
                throw new Exception("error write dashboard ".$createDashboard->getTitle());
            }

            $memberId = $this->_createMember($dashboardId, $createDashboard->getOwner(), UserRole::Owner->value);

            if($memberId === false) {
                throw new Exception("error write members for dashboard ".$createDashboard->getTitle());
            }

            $createCategoryDTO = new CreateCategory();
            $createCategoryDTO
                ->setDashboardId($dashboardId)
                ->setName("Deposit")
                ->setLogoUrl("/public/img/category_icons/deposit.png")
                ->setTypeRecord(TypeRecord::Deposit->value);

            $financeCategoryManagement = new FinanceCategoryManagement($this->pdoDB);
            $category = $financeCategoryManagement->createCategory($createCategoryDTO, true);

            if(!isset($category)) {
                throw new Exception("error write category for dashboard ".$createCategoryDTO->getName());
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
     * @param int $role_id
     * @return false|string
     */
    private function _createMember(string $dashboardId, User $owner, int $role_id): string|false
    {
        $insertSqlMember = new InsertQueryBuilder();

        $insertSqlMember
            ->insertInto('members')
            ->setValues([
                'board_id' => $dashboardId,
                'user_id' => $owner->getId(),
                'role_id' => $role_id
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
    private function _createDashboard(CreateDashboard $createDashboard): string|false
    {
        $insertSqlDashboard = new InsertQueryBuilder();

        $insertSqlDashboard
            ->insertInto('boards')
            ->setValues([
                'title' => $createDashboard->getTitle(),
                'description' => $createDashboard->getDescription(),
                'currency_denomination' => $createDashboard->getDenomination(),
            ]);

        $result = $insertSqlDashboard->execute($this->pdoDB);
        $dashboardId = $this->pdoDB->lastInsertId();
        return $dashboardId;
    }
}