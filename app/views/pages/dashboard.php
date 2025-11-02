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

    <!-- Insert Modal -->
<!--    TODO: fix hint in popup-->
    <div class="modal-overlay" id="insert-modal">
        <div class="modal-container">
            <div class="modal-header">
                <h2 class="modal-title">Добавить запись</h2>
                <button class="modal-close-btn" id="close-modal" aria-label="Закрыть">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="insert-form" class="insert-form">
                    <div class="form-group">
                        <label for="transaction-type" class="form-label">Тип операции</label>
                        <select id="transaction-type" name="transaction-type" class="form-select" required>
                            <option value="">Выберите тип</option>
                            <option value="expense">Расходы</option>
                            <option value="savings">Сбережения</option>
                            <option value="withdraw-savings">Съем денег с сбережений</option>
                            <option value="income">Пополнение</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="form-label">Сумма</label>
                        <input type="number" id="amount" name="amount" class="form-input" min="0" step="0.01" placeholder="Введите сумму" required>
                    </div>
                    <div class="form-group">
                        <label for="category" class="form-label">Категория</label>
                        <select id="category" name="category" class="form-select" required>
                            <option value="">Выберите категорию</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-cancel" id="cancel-btn">Отмена</button>
                        <button type="submit" class="btn-submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="/public/js/main.js"></script>
<script src="/public/js/dashboard/dashboard.js"></script>