<?php

namespace App\Models;

use App\Core\Manager\CsrfTokenManager;
use App\Core\Model;
use App\Requests\CreateDashboardRequest;
use App\Requests\IndexRequest;
use App\Services\FinanseDashboardManagement\FinanseDashboardManagement;
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
            throw new DomainException("Owner not exist - usename: ". $login, 500);
        }

        $finanseDashboardManagement = new FinanseDashboardManagement();
        $dashboards = $finanseDashboardManagement->findDashboardsByUserId($user->getId());

        return ['login' => $login, "csrfTokenManager" => $csrfTokenManager, "dashboards" => $dashboards];
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
            throw new DomainException("Owner not exist - usename: ". $request->getUsername(), 500);
        }

        $finanseDashboardManagement = new FinanseDashboardManagement();
        $dashboard = $finanseDashboardManagement->createDashboard($owner, $request->getNameDashboard(), $request->getDescriptionDashboard());

        if (!isset($dashboard)) {
            throw new DomainException("Failed to create dashboard", 500);
        }

        return $dashboard->getId();
    }
}