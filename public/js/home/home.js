const logoutBtn = document.querySelector(".logout-btn");
const createNewDashboardBtn = document.querySelector('.create-new-dashboard');
const popupWindowCreateNewDashboard = document.getElementById("popup-window-create-new-dashboard");
const popupWindowCreateNewDashboardCross = document.getElementById("popup-window-create-new-dashboard-cross");
const createDashboardForm = document.getElementById("createDashboardForm");
const dashboardsCell = document.querySelectorAll('.dashboard-cell');

dashboardsCell.forEach(dashboardCell => {
    dashboardCell.addEventListener('click', () => {
        const dashboard_id = dashboardCell.dataset.index
        window.location.href = "/dashboard?dashboard_id=" + dashboard_id
    });
})

logoutBtn.addEventListener('click', function (event) {
    event.preventDefault();

    logoutAction();
});

createNewDashboardBtn.addEventListener('click', (e) => {
    e.preventDefault();
    popupWindowCreateNewDashboard.classList.toggle("hidden");
})

popupWindowCreateNewDashboardCross.addEventListener("click", (e) => {
    e.preventDefault();
    popupWindowCreateNewDashboard.classList.add("hidden");
})

createDashboardForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const formData = new FormData(createDashboardForm);

    for (const [name, value] of formData.entries()) {
        if(!value.trim()) {
            alert(`The field "${name}" is required and cannot be empty.`);
            return;
        }
    }

    // Check length constraints for title and description
    const title = formData.get('title') || '';
    const description = formData.get('description') || '';

    if (title.length > 30) {
        alert('The field "title" is too long. Maximum length is 30 characters.');
        return;
    }

    if (description.length > 100) {
        alert('The field "description" is too long. Maximum length is 100 characters.');
        return;
    }

    fetch('/index/createDashboard', {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json'
        }
    })
        .then(async response => {
            const text = await response.text();
            let data;

            try {
                data = JSON.parse(text);
            } catch (e) {
                // console.error("Server did not return valid JSON:", text); //for debug!
                throw new Error("Invalid JSON from server");
            }

            if (!response.ok) {
                throw new Error(data.error || 'Unknown server error');
            }

            let id = data.data.id ?? null
            if (id) {
                console.log('Create Dashboard: ' + id)
            }

            alert("Create dashboard successful!");
            popupWindowCreateNewDashboard.classList.add("hidden");
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.code === 409) {
                alert(error);
            } else {
                alert("Something went wrong during create dashboard.");
            }
        });
    
})