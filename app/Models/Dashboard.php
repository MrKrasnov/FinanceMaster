<?php

namespace App\Models;

use App\Core\Model;
use App\Requests\DashboardRequest;
use App\Services\FinanseDashboardManagement\FinanseDashboardManagement;
use App\Services\UserManagement\UserManagement;

class Dashboard extends Model
{
    public function getDashboardIndex(DashboardRequest $request) : array
    {
        $finanseDashboardManagement = new FinanseDashboardManagement();
        $dashboards = $finanseDashboardManagement->findDashboardById($request->getDashboardId());

        $userManager = new UserManagement();
        $user = $userManager->findUserByUsername($request->getLogin());

        //TODO: get role user
        // if not role need throw error

        return [];
    }
}