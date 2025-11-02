<?php
/** @var User $user
 *  @var Dashboard $dashboard
 *  @var UserRole $role
 * */

use App\Core\Enum\UserRole;
use App\Dto\Dashboard;
use App\Dto\User;

?>
<main>
    <div class="user-panel">
        <span class="user-greeting">Hi,
            <a class="settings-hyperlink" href="#" title="open settings page"><?= $user->getLogin() ?></a> <br>
            Role: <?=$role->name?>
        </span>
        <button class="logout-btn" title="Logout">
            <img src="/public/img/logout-icon.svg" alt="Logout" width="16" height="16">
        </button>
    </div>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title"><?= htmlspecialchars($dashboard->getTitle()) ?></h1>
            <p class="dashboard-description"><?= htmlspecialchars($dashboard->getDescription()) ?></p>
        </div>

        <div class="insert-button-container">
            <button class="insert-btn">Insert</button>
        </div>

        <div class="financial-summary">
            <div class="summary-card total-income">
                <div class="summary-label">INCOME</div>
                <div class="summary-amount" id="total-income">0 UAH</div>
            </div>

            <div class="summary-card total-balance">
                <div class="summary-label">BALANCE</div>
                <div class="summary-amount" id="total-balance">0 UAH</div>
            </div>

            <div class="summary-card total-expense">
                <div class="summary-label">EXPENSES</div>
                <div class="summary-amount" id="total-expense">0 UAH</div>
            </div>
        </div>

        <div class="categories-table-container">
            <table class="categories-table">
                <thead>
                    <tr>
                        <th>CATEGORY</th>
                        <th>TYPE</th>
                        <th>AMOUNT</th>
                        <th>RECORD COUNT</th>
                        <th>LAST UPDATE</th>
                    </tr>
                </thead>
                <tbody id="categories-tbody">
                    <tr class="empty-row">
                        <td colspan="5" class="empty-message">No data for display</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="/public/js/main.js"></script>
<script src="/public/js/dashboard/dashboard.js"></script>