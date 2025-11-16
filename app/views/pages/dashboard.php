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
                <h2 class="modal-title">Add new record</h2>
                <button class="modal-close-btn" id="close-modal" aria-label="Закрыть">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-step modal-step-type" id="modal-step-type">
                    <p class="modal-hint">Select the type of financial operation:</p>
                    <div class="type-select-grid">
                        <button
                            type="button"
                            class="type-select-btn type-select-expenses"
                            data-type-record="0"
                        >
                            <span class="type-select-title">Expenses</span>
                            <span class="type-select-subtitle">Purchases, payments, bills</span>
                        </button>

                        <button
                            type="button"
                            class="type-select-btn type-select-deposit"
                            data-type-record="3"
                        >
                            <span class="type-select-title">Deposit</span>
                            <span class="type-select-subtitle">Salary, transfers, deposits</span>
                        </button>

                        <button
                            type="button"
                            class="type-select-btn type-select-savings"
                            data-type-record="1"
                        >
                            <span class="type-select-title">Savings</span>
                            <span class="type-select-subtitle">Transfer to savings</span>
                        </button>

                        <button
                            type="button"
                            class="type-select-btn type-select-savings-withdrawal"
                            data-type-record="2"
                        >
                            <span class="type-select-title">Withdrawal from savings</span>
                            <span class="type-select-subtitle">Reverse transfer from savings</span>
                        </button>
                    </div>
                </div>


                <!--TODO: change form for insert record-->
                <div class="modal-step modal-step-form" id="modal-step-form" style="display: none;">
                    <form id="insert-form" class="insert-form">
                        <input type="hidden" id="type-record" name="type_record" value="">

                        <div class="form-group">
                            <label for="transaction-type" class="form-label">Type of operation</label>
                            <select id="transaction-type" name="transaction_type" class="form-select" disabled>
                                <option value="0">Expenses</option>
                                <option value="3">Deposit</option>
                                <option value="1">Savings</option>
                                <option value="2">Withdrawal from savings</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="form-label">Amount</label>
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                id="amount"
                                name="amount"
                                class="form-input"
                                placeholder="Enter the amount"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="category" class="form-label">Category</label>
                            <input
                                type="text"
                                id="category"
                                name="category"
                                class="form-input"
                                placeholder="For example: Products, Rent, Salary"
                                required
                            >
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-cancel" id="cancel-btn">Cancel</button>
                            <button type="submit" class="btn-submit">Add</button>
                        </div>
                    </form>
                </div>
                <!------------------------------------------->
            </div>
        </div>
    </div>
</main>
<script src="/public/js/main.js"></script>
<script src="/public/js/dashboard/dashboard.js"></script>