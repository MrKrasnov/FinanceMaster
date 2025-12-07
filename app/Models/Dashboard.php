<?php

namespace App\Models;

use App\Core\Enum\TypeRecord;
use App\Core\Log;
use App\Core\Manager\CsrfTokenManager;
use App\Core\Model;
use App\Dto\Category\CreateCategory;
use App\Dto\Records\CreateRecord;
use App\Requests\DashboardRequest;
use App\Requests\InsertDepositRequest;
use App\Services\FinanceCategoryManagement\FinanceCategoryManagement;
use App\Services\FinanceRecordManagement\FinanceRecordManagement;
use App\Services\FinanseDashboardManagement\FinanceDashboardManagement;
use App\Services\UserManagement\UserManagement;
use DomainException;
use Exception;

class Dashboard extends Model
{
    public function getDashboardIndex(DashboardRequest $request) : array
    {
        $csrfTokenManager = new CsrfTokenManager();
        $csrfTokenManager->generateCSRFToken();
        $csrfTokenManager->generateCSRFTokenLifeExpire();

        $finanseDashboardManagement = new FinanceDashboardManagement();
        $dashboard = $finanseDashboardManagement->findDashboardById($request->getDashboardId());

        $userManager = new UserManagement();
        $user = $userManager->findUserByUsername($request->getLogin());

        $roleUser = $finanseDashboardManagement->findRoleUser($user->getId(), $dashboard->getId());

        return ["dashboard" => $dashboard, "user" => $user, "role" => $roleUser, 'csrfTokenManager' => $csrfTokenManager];
    }

    /**
     * @throws Exception
     */
    function createRecordDeposit(InsertDepositRequest $request) : int
    {
        $financeRecordManagement = new FinanceRecordManagement();

        $createRecordDto = new CreateRecord();
        $createRecordDto
            ->setByUser($request->getByUser())
            ->setPrice($request->getAmount())
            ->setName($request->getCategory())
            ->setCategoryId($this->createDepositCategoryIfNotExist($request->getCategory(), $request->getBoardId()));

        $record = $financeRecordManagement->createRecord($createRecordDto);

        if (!isset($record)) {
            throw new DomainException("Failed to create record", 500);
        }

        return $record->getCategoryId();
    }

    /**
     * @throws Exception
     */
    private function createDepositCategoryIfNotExist(string $nameCategory, int $dashboardID) : int
    {
        $financeCategoryManagement = new FinanceCategoryManagement();
        $resultFind = $financeCategoryManagement->findCategoryByNameAndDashboardId($nameCategory, $dashboardID);

        if(isset($resultFind)) {
            return $resultFind->getId();
        }

        Log::writeLog("Strange error, when creating the board, the Deposite category was not created. Check Dashboard -> $dashboardID");

        $createCategoryDTO = new CreateCategory();
        $createCategoryDTO
            ->setDashboardId($dashboardID)
            ->setName($nameCategory)
            ->setLogoUrl("/public/img/category_icons/deposit.png")
            ->setTypeRecord(TypeRecord::Deposit->value);

        $financeCategoryManagement = new FinanceCategoryManagement();
        $category = $financeCategoryManagement->createCategory($createCategoryDTO, true);

        if(!isset($category)) {
            throw new Exception("error write category for dashboard ".$createCategoryDTO->getName());
        }

        return $category->getId();
    }
}