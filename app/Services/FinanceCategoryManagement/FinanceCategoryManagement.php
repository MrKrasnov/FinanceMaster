<?php

namespace App\Services\FinanceCategoryManagement;

use App\Core\DB;
use App\Core\Log;
use App\Core\Management;
use App\Dto\Category;
use App\Dto\CreateCategory;
use App\Services\FinanseDashboardManagement\FinanceDashboardManagement;
use App\Services\SQLQueryBuilder\InsertQueryBuilder;
use App\Services\SQLQueryBuilder\SelectQueryBuilder;
use Exception;
use PDO;

class FinanceCategoryManagement extends Management
{
    /**
     * @throws Exception
     */
    public function createCategory(CreateCategory $createCategoryParams, bool $isTransaction = false) : ?Category
    {
        $financeDashboardManagement = new FinanceDashboardManagement();

        if(!$isTransaction) {
            $dashboard = $financeDashboardManagement->findDashboardById($createCategoryParams->getDashboardId());

            if (!isset($dashboard)) {
                $errorMsg = "I can't find the dashboard with id = 
                " . $createCategoryParams->getDashboardId() . " when trying to create a category.";
                Log::writeLog($errorMsg);
                throw new Exception($errorMsg, 500);
            }

            $category = $this->findCategoryByNameAndDashboardId(
                $createCategoryParams->getName(),
                $createCategoryParams->getDashboardId()
            );

            if (isset($category)) {
                $errorMsg = "I cannot create a category because an entry with that name already exists. 
                Name " . $createCategoryParams->getName() . " board_id ". $createCategoryParams->getDashboardId();
                Log::writeLog($errorMsg);
                throw new Exception($errorMsg, 409);
            }
        }

        $categoryId = $this->_createCategory($createCategoryParams);

        if($categoryId === false) {
            throw new Exception("error write category ".$createCategoryParams->getName(), 500);
        }

        return $this->findCategoryById($categoryId);
    }

    public function findCategoryById(int $id) : ?Category
    {
        $selectSql = new SelectQueryBuilder();
        $selectSql
            ->select(['*'])
            ->from('categories')
            ->where(['id' => $id]);

        $result = $selectSql->execute($this->pdoDB);

        if (!empty($result)) {
            if(count($result) > 1) {
                Log::writeLog("Found category more than one in findCategoryById. Check id $id");
            }

            return $this->convertArrayToDashboard($result[0]);
        }

        return null;
    }

    public function findCategoryByNameAndDashboardId(string $name, int $dashboardId) : ?Category
    {
        $selectSql = new SelectQueryBuilder();
        $selectSql
            ->select(['*'])
            ->from('categories')
            ->where(['name' => $name, 'board_id' => $dashboardId]);

        $result = $selectSql->execute($this->pdoDB);

        if (!empty($result)) {
            if(count($result) > 1) {
                Log::writeLog("Found category more than one in findCategoryByNameAndDashboardId. 
                Check name $name and board_id ".$dashboardId);
            }

            return $this->convertArrayToDashboard($result[0]);
        }

        return null;
    }

    private function _createCategory(CreateCategory $createCategoryParams) : string|false
    {
        $insertSqlCategory = new InsertQueryBuilder();

        $insertSqlCategory
            ->insertInto('categories')
            ->setValues([
                'name' => $createCategoryParams->getName(),
                'logo_url' => $createCategoryParams->getLogoUrl(),
                'board_id' => $createCategoryParams->getDashboardId(),
                'type_records' => $createCategoryParams->getTypeRecord()
            ]);

        $result = $insertSqlCategory->execute($this->pdoDB);
        $categoryId = $this->pdoDB->lastInsertId();
        return $categoryId;
    }

    private function convertArrayToDashboard(array $data): Category
    {
        $category = new Category();
        if (isset($data['id'])) $category->setId((string)$data['id']);
        if (isset($data['title'])) $category->setName($data['name']);
        if (isset($data['description'])) $category->setLogoUrl($data['logo_url']);
        if (isset($data['created_at'])) $category->setBoardId($data['board_id']);
        if (isset($data['updated_at'])) $category->setTypeRecord($data['type_records']);
        return $category;
    }
}