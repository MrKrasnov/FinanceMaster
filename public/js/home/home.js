let logoutBtn = document.querySelector(".logout-btn");

logoutBtn.addEventListener('click', function (event) {
    event.preventDefault();

    fetch('/index/logout', {
        method: 'POST',
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            window.location.href = '/authentication';
        }
    }).catch(error => {
        console.error('Error:', error);
        alert(error.message);
    });
});