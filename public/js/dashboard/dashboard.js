const logoutBtn = document.querySelector(".logout-btn");

if (logoutBtn) {
    logoutBtn.addEventListener('click', function (event) {
        event.preventDefault();

        logoutAction();
    });
}

const insertBtn = document.querySelector(".insert-btn");
const insertModal = document.getElementById("insert-modal");
const closeModalBtn = document.getElementById("close-modal");
const cancelBtn = document.getElementById("cancel-btn");
const modalStepType = document.getElementById("modal-step-type");

const modalExpensesForm = document.getElementById("modal-expenses-form");
const modalSavingsForm = document.getElementById("modal-savings-form");
const modalSavingsWithdrawalForm = document.getElementById("modal-savingsWithdrawal-form");
const modalDepositForm = document.getElementById("modal-deposit-form");

const modalExpensesInsertForm = document.getElementById("modal-expenses-insert-form");
const modalSavingsInsertForm = document.getElementById("modal-savings-insert-form");
const modalSavingsWithdrawalInsertForm = document.getElementById("modal-savingsWithdrawal-insert-form");
const modalDepositInsertForm = document.getElementById("modal-deposit-insert-form");

const typeButtons = document.querySelectorAll(".type-select-btn");

if (insertBtn && insertModal) {
    insertBtn.addEventListener('click', function (event) {
        event.preventDefault();
        openModal();
    });
}

if (closeModalBtn) {
    closeModalBtn.addEventListener('click', function (event) {
        event.preventDefault();
        closeModal();
    });
}

if (cancelBtn) {
    cancelBtn.addEventListener('click', function (event) {
        event.preventDefault();
        closeModal();
    });
}

let isExistModalForm = modalExpensesForm && modalSavingsForm && modalSavingsWithdrawalForm && modalDepositForm;

if (typeButtons && modalStepType && isExistModalForm) {
    typeButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const typeValue = button.getAttribute('data-type-record');

            switch (typeValue) {
                case "0":
                    modalExpensesForm.style.display = 'block';
                    break;
                case "1":
                    modalSavingsForm.style.display = 'block';
                    break;
                case "2":
                    modalSavingsWithdrawalForm.style.display = 'block';
                    break;
                case "3":
                    modalDepositForm.style.display = 'block';
                    break;
                default:
                    return;
            }

            modalStepType.style.display = 'none';
        });
    });
}

if (insertModal) {
    insertModal.addEventListener('click', function (event) {
        if (event.target === insertModal) {
            closeModal();
        }
    });
}

document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && insertModal && insertModal.classList.contains('active')) {
        closeModal();
    }
});

function openModal() {
    if (insertModal) {
        insertModal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling

        collapseStateForModalForm()

        if (insertForm) {
            insertForm.reset();
        }
    }
}

function closeModal() {
    if (insertModal) {
        insertModal.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling

        collapseStateForModalForm()

        if (insertForm) {
            insertForm.reset();
        }
    }
}

function collapseStateForModalForm() {
    if (modalStepType && isExistModalForm) {
        modalStepType.style.display = 'block';
        modalExpensesForm.style.display = 'none';
        modalSavingsForm.style.display = 'none';
        modalSavingsWithdrawalForm.style.display = 'none';
        modalDepositForm.style.display = 'none';
    }
}

if (modalExpensesInsertForm) {
    modalExpensesInsertForm.addEventListener('submit', function (event) {
        event.preventDefault();

    });
}

if (modalSavingsInsertForm) {
    modalSavingsInsertForm.addEventListener('submit', function (event) {
        event.preventDefault();

    });
}

if (modalSavingsWithdrawalInsertForm) {
    modalSavingsWithdrawalInsertForm.addEventListener('submit', function (event) {
        event.preventDefault();

    });
}

if (modalDepositInsertForm) {
    modalDepositInsertForm.addEventListener('submit', function (event) {
        event.preventDefault();

    });
}
