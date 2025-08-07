const logoutBtn = document.querySelector(".logout-btn");
const createNewDashboardBtn = document.querySelector('.create-new-dashboard');
const popupWindowCreateNewDashboard = document.getElementById("popup-window-create-new-dashboard");
const popupWindowCreateNewDashboardCross = document.getElementById("popup-window-create-new-dashboard-cross");
const pushForCreateDashboard = document.getElementById("push-for-create-dashboard");

logoutBtn.addEventListener('click', function (event) {
    event.preventDefault();

    fetch('/index/logout', {
        method: 'POST',
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

        window.location.href = '/authentication';
    }).catch(error => {
        console.error('Error:', error);
        alert(error.message);
    });
});

createNewDashboardBtn.addEventListener('click', (e) => {
    e.preventDefault();
    popupWindowCreateNewDashboard.classList.toggle("hidden");
})

popupWindowCreateNewDashboardCross.addEventListener("click", (e) => {
    e.preventDefault();
    popupWindowCreateNewDashboard.classList.add("hidden");
})

pushForCreateDashboard.addEventListener("click", (e) => {
    e.preventDefault();

    //TODO: Send form to backend
})