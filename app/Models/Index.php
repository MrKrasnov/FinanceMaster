<?php

namespace App\Models;

use App\Core\Manager\CsrfTokenManager;
use App\Core\Model;
use App\Dto\Dashboard\CreateDashboard;
use App\Requests\CreateDashboardRequest;
use App\Requests\IndexRequest;
use App\Services\FinanseDashboardManagement\FinanceDashboardManagement;
use App\Services\UserManagement\UserManagement;
use DomainException;

class Index extends Model
{
    public function getFinansesIndex(IndexRequest $request) : array
    {
        $login = $request->getLogin();

        $csrfTokenManager = new CsrfTokenManager();
        $csrfTokenManager->generateCSRFToken();
        $csrfTokenManager->generateCSRFTokenLifeExpire();

        $userManager = new UserManagement();
        $user = $userManager->findUserByUsername($login);

        if (!isset($user)) {
            throw new DomainException("User not exist - username: ". $login, 500);
        }

        $finanseDashboardManagement = new FinanceDashboardManagement();
        $dashboards = $finanseDashboardManagement->findDashboardsByUserId($user->getId());

        return ['login' => $login, "csrfTokenManager" => $csrfTokenManager, "dashboards" => array_reverse($dashboards)];
    }

    public function logout()
    {
        $userManager = new UserManagement();
        $userManager->logout();
    }

    /**
     * @throws \Exception
     */
    public function createDashboard(CreateDashboardRequest $request) : int
    {
        $userManager = new UserManagement();
        $owner = $userManager->findUserByUsername($request->getUsername());

        if (!isset($owner)) {
            throw new DomainException("Owner not exist - username: ". $request->getUsername(), 500);
        }

        $finanseDashboardManagement = new FinanceDashboardManagement();
        $createDashboardDTO         = new CreateDashboard();
        $createDashboardDTO
            ->setOwner($owner)
            ->setTitle($request->getNameDashboard())
            ->setDescription($request->getDescriptionDashboard())
            ->setDenomination($request->getCurrency_denomination());
        $dashboard = $finanseDashboardManagement->createDashboard($createDashboardDTO);

        if (!isset($dashboard)) {
            throw new DomainException("Failed to create dashboard", 500);
        }

        return $dashboard->getId();
    }
}