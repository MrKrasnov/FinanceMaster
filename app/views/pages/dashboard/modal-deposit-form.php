<div class="modal-step modal-deposit-form" id="modal-deposit-form" style="display: none;">
    <form id="insert-form" class="insert-form">

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

        <div class="form-actions">
            <button type="button" class="btn-cancel" id="cancel-btn">Back</button>
            <button type="submit" class="btn-submit">Add</button>
        </div>
    </form>
</div>