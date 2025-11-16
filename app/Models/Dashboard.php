<?php

namespace App\Models;

use App\Core\Manager\CsrfTokenManager;
use App\Core\Model;
use App\Requests\DashboardRequest;
use App\Services\FinanseDashboardManagement\FinanceDashboardManagement;
use App\Services\UserManagement\UserManagement;

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
}