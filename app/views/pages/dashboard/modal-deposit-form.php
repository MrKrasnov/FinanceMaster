<?php
/** @var User $user
 *  @var Dashboard $dashboard
 *  @var UserRole $role
 * */

use App\Core\Enum\UserRole;
use App\Dto\Dashboard;
use App\Dto\User;

?>
<div class="modal-step modal-deposit-form" id="modal-deposit-form" style="display: none;">

    <form id="modal-deposit-insert-form" class="insert-form">
        <h3>Salary, transfers.</h3>
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

        <input type="hidden" name="by_user" value="<?=$user->getLogin()?>">
        <input type="hidden" name="category" value="Deposit">

        <div class="form-actions">
            <button type="button" class="btn-cancel" id="cancel-btn">Back</button>
            <button type="submit" class="btn-submit">Add</button>
        </div>
    </form>
</div>