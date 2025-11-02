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
    }
}

function closeModal() {
    if (insertModal) {
        insertModal.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
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
