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
const insertForm = document.getElementById("insert-form");
const modalStepType = document.getElementById("modal-step-type");
const modalStepForm = document.getElementById("modal-step-form");
const typeButtons = document.querySelectorAll(".type-select-btn");
const transactionTypeSelect = document.getElementById("transaction-type");
const typeRecordInput = document.getElementById("type-record");

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

if (typeButtons && modalStepType && modalStepForm) {
    typeButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const typeValue = button.getAttribute('data-type-record');

            if (transactionTypeSelect) {
                transactionTypeSelect.value = typeValue;
            }

            if (typeRecordInput) {
                typeRecordInput.value = typeValue;
            }

            modalStepType.style.display = 'none';
            modalStepForm.style.display = 'block';
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

        if (modalStepType && modalStepForm) {
            modalStepType.style.display = 'block';
            modalStepForm.style.display = 'none';
        }

        if (insertForm) {
            insertForm.reset();
        }
    }
}

function closeModal() {
    if (insertModal) {
        insertModal.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling

        if (modalStepType && modalStepForm) {
            modalStepType.style.display = 'block';
            modalStepForm.style.display = 'none';
        }

        if (insertForm) {
            insertForm.reset();
        }
    }
}

if (insertForm) {
    insertForm.addEventListener('submit', function (event) {
        event.preventDefault();
        
        // Here you can add form submission logic
        const formData = {
            type: document.getElementById('transaction-type').value,
            amount: document.getElementById('amount').value,
            category: document.getElementById('category').value
        };
        
        console.log('Form data:', formData);
        
        // TODO: Implement actual form submission
        // closeModal();
    });
}
